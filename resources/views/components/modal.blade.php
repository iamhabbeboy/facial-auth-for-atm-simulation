<div class="modal" tabindex="-1" role="dialog" id="cameraModal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <video style="width: 700px;border:6px solid #333" autoplay="" id="video"></video>
                <audio id="audio" src="/plugin/shot.mp3" autoplay="false"></audio>
                <div >
                    <canvas id="canvas" style="display:none;" width="700" height="528"></canvas>
                   <div id="image-preview"></div>
                   <!-- style="width: 100px;max-width:100%;border:3px solid #333"> -->
                 </div>
                 <button id="start-camera" class="btn btn-info btn-lg">Start Camera</button>
                <button id="take-picture" class="btn btn-primary btn-lg">Take Picture</button>
                {{-- <button id="http-click">Save</button> --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="http-click">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>