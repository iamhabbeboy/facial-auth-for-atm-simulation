! function($) {
    "use strict";
    const WIDTH = 700;
    const HEIGHT = 528;
    const INTERVAL = 2000;
    const IMAGE_NUMBER = 5;
    const APP_ID = "4985f625";
    const APP_KEY = "aa9e5d2ec3b00306b2d9588c3a25d68e";

    let MLModule = function(status) {
        this.canvas = document.getElementById('canvas');
        this.video = document.querySelector('#video');
        this.audio = document.querySelector('#audio');
        this.image = document.querySelector('#image-preview');
        this.shotButton = document.querySelector('#take-picture');
        this.countdown = document.querySelector('#countdown');
        this.httpButton = document.querySelector('#http-click');
        this.storeImages = [];
        this.support();
        if (status == 'enroll') {
            this.http();
        } else {
            this.verify();
        }
    };

    MLModule.prototype.support = function() {
        navigator.getUserMedia = navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            msGetUsermedia;

        if (navigator.getUserMedia) {
            const that = this;
            let start;
            navigator.getUserMedia({ audio: false, video: true }, function(stream) {
                console.log(stream);
                that.video.srcObject = stream;
                that.video.play();
                that.takeshot(start);
            }, function(error) { alert(error) });
        }
    };

    MLModule.prototype.takeshot = function(imageIndex) {
        const that = this;
        let action = 1;
        let timer;

        this.shotButton.addEventListener('click', function() {

            that.manipulateImage();
            // timer = setInterval(function() {
            //     action++;
            //     // that.countdown.innerText = 1;
            //     if (action <= IMAGE_NUMBER) {
            //         that.countdown.innerText = action;
            //         that.manipulateImage()
            //         console.log(action)
            //     } else {
            //         clearInterval(timer);
            //     }
            //     // that.countdown.innerText = parseInt(that.countdown.innerText) + 1
            // }, INTERVAL);
        });
    };

    MLModule.prototype.manipulateImage = function() {
        const that = this;
        let img = document.createElement('img');
        this.canvas.getContext('2d').drawImage(this.video, 0, 0, WIDTH, HEIGHT);
        let imgsrc = that.canvas.toDataURL('image/png');
        img.src = imgsrc
        img.width = '100';
        img.height = '100';
        that.image.appendChild(img);
        // that.image.innerHTML = img;
        this.audio.play();
        this.storeImages.push(imgsrc);
    };

    MLModule.prototype.http = function() {
        const that = this;
        this.httpButton.addEventListener('click', function() {
            // let dataString = 
             let formRequest = that.formRequest();
            formRequest['image'] = that.storeImages[that.storeImages.length - 1];

            const config = {
                url: '/register',
                data: formRequest,
                method: 'POST'
            };
            this.setAttribute("disabled", "");
            this.innerHTML = "<i>please wait...</i>";
            that.request(config).then(function(resp) {
                console.log(resp);
                // const json = JSON.parse(resp);
                if (resp) {
                    window.location = "/home";
                } else {
                    alert("Error Occured while processing");
                }
            }).catch(function(err) {
                console.log(err)
            })
        });
    };

    MLModule.prototype.verify = function() {
        const that = this;
        this.httpButton.addEventListener('click', function() {
            // let dataString = 
             let formRequest = that.formVerifyRequest();
            formRequest['image'] = that.storeImages[that.storeImages.length - 1];

            const config = {
                url: '/transfer-fund',
                data: formRequest,
                method: 'POST'
            };
            this.setAttribute("disabled", "");
            this.innerHTML = "<i>please wait...</i>";
            that.request(config).then(function(resp) {
                if (resp) {
                    window.alert("Fund successfully transfered");
                    window.location = "/home";
                }
            }).catch(function(err) {
                console.log(err)
                alert("Error occured, please reload")
            })
        });
    };

    MLModule.prototype.formVerifyRequest = function() {
        const desc = $('#desc');
        const amount = $('#amount');
        const token = $('#token');
        const acct_num = $('#account_number');

        return {
            desc: desc.val(),
            _token: token.val(),
            amount: amount.val(),
            receiver: acct_num.val(),
        };
    };

    MLModule.prototype.formRequest = function() {
        const dob = $('#dob')
        const token = $('#token')
        const state = $('#state');
        const title = $('#title');
        const other = $('#othername')
        const country = $('#country');
        const address = $('#address');
        const surname = $('#surname');
        const phone = $('#phone_number');
        const email = $('#email_address');
        const account_type = $('#account_type');
        return {
            dob: dob.val(),
            state: state.val(),
            title: title.val(),
            _token: token.val(),
            country: country.val(),
            address: address.val(),
            surname: surname.val(),
            othername: other.val(),
            phone_number: phone.val(),
            email_address: email.val(),
            account_type: account_type.val(),
        }
    }

    MLModule.prototype.request = function(config) {
        return $.ajax(config);
    }
    window.MLModule = MLModule;
}($);
