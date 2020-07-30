<div id="a2h-box" style="display: none; position: fixed; top: 0; left: 0; right: 0; height: auto; width: 100%; z-index: 9999; min-height: 40px; color: #282b2d; background-color: #e7efff; padding: 5px 20px 5px 20px; border-bottom: 2px solid #191919;">
    <div class="row">
        <div class="col-6">
            <span style="line-height: 30px;">Install {{ config('app.name') }} App?</span>
        </div>

        <div class="col-6 text-right">
            <button id="btn-reject" class="btn btn-sm btn-light">
                Ignore
            </button>
            <button id="btn-accept" class="btn btn-sm btn-primary platform-android ml-1">
                Install App
            </button>
        </div>
    </div>

    <div class="platform-ios">
        Tap
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon-iphone-popup"
             style="width: 20px; height: 20px; transform: translate(0px, 3px); -ms-transform: translate(0px, 3px); -webkit-transform: translate(0px, 3px); -o-transform: translate(0px, 3px); -moz-transform: translate(0px, 3px); enable-background:new 0 0 58.999 58.999;"
             viewBox="0 0 58.999 58.999" xml:space="preserve">
                <path d="M19.479,12.019c0.256,0,0.512-0.098,0.707-0.293l8.313-8.313v35.586c0,0.553,0.447,1,1,1s1-0.447,1-1V3.413l8.272,8.272
                    c0.391,0.391,1.023,0.391,1.414,0s0.391-1.023,0-1.414l-9.978-9.978c-0.092-0.093-0.203-0.166-0.327-0.217
                    c-0.244-0.101-0.519-0.101-0.764,0c-0.123,0.051-0.234,0.125-0.326,0.217L18.772,10.312c-0.391,0.391-0.391,1.023,0,1.414
                    C18.967,11.922,19.223,12.019,19.479,12.019z"></path>
            <path d="M36.499,15.999c-0.553,0-1,0.447-1,1s0.447,1,1,1h13v39h-40v-39h13c0.553,0,1-0.447,1-1s-0.447-1-1-1h-15v43h44v-43H36.499z"></path>
        </svg>
        then 'Add to Home Screen'
    </div>
</div>
