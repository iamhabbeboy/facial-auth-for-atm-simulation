<?php

namespace App\Http\Controllers;

use App\AccountManager;
use App\Banking;
use App\FundManager;
use App\Support\KairosFacialRecognition as Kairos;
use Illuminate\Http\Request;
use Session;

class AccountManagerController extends Controller
{
    /**
     * @var mixed
     */
    protected $accountManager;
    /**
     * @var mixed
     */
    protected $banking;

    /**
     * @param AccountManager $account
     */
    public function __construct(AccountManager $account, Banking $banking)
    {

        $this->banking = $banking;
        $this->accountManager = $account;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }

    public function transfer()
    {
        $userInfo = session('user_account');
        $model = $this->accountManager->fullInfo($userInfo)
            ->first()->toArray();
        return view('transfer', compact('model'));
    }
    public function withdrawal()
    {
        $userInfo = session('user_account');
        $model = $this->accountManager->fullInfo($userInfo)
            ->first()->toArray();
        return view('withdraw', compact('model'));
    }

    public function fundAccount()
    {
        $userInfo = session('user_account');
        $model = $this->accountManager->fullInfo($userInfo)
            ->first()->toArray();
        return view('fund', compact('model'));
    }

    /**
     * @param Request $request
     */
    public function fundAmount(Request $request)
    {
        $user = session('user_account');
        $user_info = $this->banking->create([
            'user_id' => $user->id,
            'account_type' => $user->account_type,
            'balance' => $request->amount,
        ]);
        return back()->withError('Account funded successfully')->withInput();
    }

    public function signout()
    {
        session::forget('user_account');
        return redirect('/');
    }

    public function profile()
    {
        $userInfo = session('user_account');
        $model = $this->accountManager->fullInfo($userInfo)
            ->first()->toArray();
        return view('profile', compact('model'));
    }

    /**
     * @param Request $request
     */
    public function profileUpdate(Request $request)
    {
        $phone = $request->phone_number;
        $password = $request->password;
        $user = session('user_account');
        $user = $this->accountManager->find($user->id);
        $data = [];

        if ($password === null) {
            $data['phone_number'] = $phone;
        } else {
            $data['phone_number'] = $phone;
            $data['password'] = $password;
        }
        $response = $user->fill($data)->save();
        return back()->withError('Profile updated successfully')->withInput();
    }

    /**
     * @param Request $request
     */
    public function fundTransfer(Request $request)
    {
        $data = $request->all();
        $user = session('user_account');
        $data['user_id'] = $user->id;
        $data['transaction_type'] = "";
        $responseStatus = [];

        $kairos = new Kairos;
        $response = $kairos->detectOrVerify($data['image']);
        $json = json_decode($response, true);

        $userConfirmed = array_get($json, 'images.0.candidates.0.confidence');
        $confidence = explode('.', $userConfirmed);

        if (array_get($confidence, '1') < 7) {
            $responseStatus['status'] = 'failed';
            return response()->json($responseStatus);
        }
        $response = FundManager::create($data);
        $responseStatus['status'] = 'success';
        $this->deduction($data['amount'], $user->id);

        return response()->json($responseStatus);
    }

    /**
     * @param $amount
     * @param $user
     */
    public function deduction($amount, $user)
    {
        $finder = $this->banking->where('user_id', $user)->orderBy('id', 'desc')->first();
        $balance = (float) $finder->balance - (float) $amount;
        $finder->fill(['balance' => $balance])->save();
    }

    public function dashboard()
    {
        $userInfo = session('user_account');
        $model = $this->accountManager->fullInfo($userInfo)
            ->first()->toArray();

        return view('dashboard', compact('model'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function fetchAccountDetails(Request $request)
    {
        $query = $this->accountManager->where('account_number', $request->acct_num);
        return $query->first() !== null ? $query->first()->toArray() : [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $image = array_get($data, 'image');
        //photo
        $imageOutput = $this->processImage($image);
        $postData = [];
        $firstName = strtolower(array_get($data, 'other'));
        $lastName = strtolower(array_get($data, 'surname'));

        $postData['image'] = $image;
        $postData['subject_id'] = ucfirst($firstName) . ucfirst($lastName);
        //facial_response
        $response = $this->facialRecognitionWithKairos($postData);
        $data['photo'] = $imageOutput;
        $data['facial_response'] = json_encode($response);

        $data['account_number'] = substr(mt_rand(1000000000, 9999999999), 0, 10);
        $data['password'] = substr(mt_rand(100000, 999999), 0, 6);
        $response = $this->accountManager->firstOrCreate(['email_address' => $request->email_address], $data);

        if (!$response) {
            return back()->withError('Error Occured while processing info')->withInput();
        }

        $this->banking->create([
            'user_id' => $response->id,
            'account_type' => $response->account_type,
            'balance' => '0.0',
        ]);

        session(['user_account' => $response]);
        return response()->json(['status' => 'success']);
        // return redirect(route('account_dashboard'));
    }

    /**
     * @param $image
     * @return mixed
     */
    public function processImage($image)
    {
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $folderPath = public_path() . "/webcam/";
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        return $fileName;
    }

    /**
     * @param array $postData
     */
    private function facialRecognitionWithKairos($postData)
    {
        $kairos = new Kairos;
        return $kairos->enroll($postData);
    }

    public function balance(Request $request)
    {
        $amount = (float) $request->amount;
        $userInfo = session('user_account');
        $response = [];

        $sql = $this->banking->where('user_id', $userInfo->id)->orderBy('id', 'desc');
        $balance = ($sql->count() > 0) ? $sql->first()->balance : 0;

        $response['status'] = ($amount > 1 && $balance >= $amount) ? 'success' : 'failed';
        return response()->json($response);
    }
}
