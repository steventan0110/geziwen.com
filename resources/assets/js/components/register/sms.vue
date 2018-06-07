<template>
    <div>
        <div class="form-group row">
            <label for="phone-number" class="col-md-4 col-form-label text-md-right">请输入手机号</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input id="phone-number" type="tel" v-bind:class="registered ? 'is-invalid' : '' " class="form-control" v-model="strMobile" name="mobile" required>
                </div>
                <span class="invalid-feedback" v-show="registered" style="display: block">
                    <strong>该手机号已被注册</strong>
                </span>
                <span class="text-success" v-show="success" style="display: block">
                    <strong>验证码已发送，请注意查收</strong>
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="mobile-vcode" class="col-md-4 col-form-label text-md-right">请输入验证码</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input id="mobile-vcode" type="number" v-bind:class="this.showCodeError ? 'is-invalid' : '' "  class="form-control" name="vcode" required>
                    <div class="input-group-append">
                        <button id="sendVerifySmsButton" :disabled="sendDisabled" type="button" class="btn btn-primary" @click="send">
                            <span v-if="sendMsgDisabled">{{countDown+'秒后获取'}}</span>
                            <span v-if="!sendMsgDisabled">发送验证码</span>
                        </button>
                    </div>
                </div>
                <span class="invalid-feedback" v-show="this.showCodeError" style="display: block">
                    <strong>{{ this.codeErrorMessage }}</strong>
                </span>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button @click="submit" class="btn btn-primary mr-4" v-bind:disabled="registered">
                    注册
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sms-component",
        props: ['showCodeError', 'codeErrorMessage'],
        data() {
            return {
                strMobile: undefined,
                registered: false,
                success: false,
                sig: "",
                urlRandom: 0,
                time: 0,
                countDown: 30, // 发送验证码倒计时
                sendMsgDisabled: false,
                sendDisabled: true,
            }
        },
        watch: {
            strMobile: function(){
                this.debouncedGetMobile();
            }
        },
        created: function () {
            // `_.debounce` 是一个通过 Lodash 限制操作频率的函数。
            // 参考：https://lodash.com/docs#debounce
            this.debouncedGetMobile = _.debounce(this.validate, 500)
        },
        methods: {
            send() {
                let _this = this;
                this.generate();
                this.countDown = 30;
                this.time = Math.round(new Date() / 1000);
                let sha256 = require("js-sha256").sha256;
                this.sig = sha256('appkey=bcad564f87d99ce5d0c933e54af396e4&random='+this.urlRandom+'&time='+this.time+'&mobile='+this.strMobile);
                this.$http.post("/api/sms/send", {
                    'phoneNumber': this.strMobile,
                    'sig': this.sig,
                    'urlRandom': this.urlRandom,
                    'time': this.time,
                }).then(function(response){
                        // console.log(response.status);
                        _this.success = true;
                        _this.changeButton();
                    },function(response){
                        // console.log(response.status);
                        // console.log(response.body);
                        _this.success = false;
                    }
                );
            },
            generate() {
                for(var i=0;i<4;i++){
                    this.urlRandom+=parseInt(Math.random()*Math.pow(10,i));
                }
            },
            changeButton() {
                let _this = this;
                _this.sendMsgDisabled = true;
                _this.sendDisabled = true;
                let timer = setInterval(function() {
                    if(_this.countDown > 0) {
                        _this.countDown--;
                    }
                    else{
                        _this.sendMsgDisabled = false;
                        _this.sendDisabled = false;
                        window.clearInterval(timer);
                    }
                }, 1000);
            },
            validate(){
                let _this = this;
                if(this.strMobile == ""){
                    _this.registered = false;
                    _this.sendDisabled = true;
                }
                else {
                    this.$http.post("/api/sms/test", {
                        'phoneNumber': this.strMobile,
                    }).then(function (response) {
                            // console.log(response.status);
                            _this.registered = false;
                            _this.sendDisabled = false;
                        }, function (response) {
                            // console.log(response.status);
                            // console.log(response.body);
                            _this.registered = true;
                            _this.sendDisabled = true;
                        }
                    );
                }
            },
            submit(){
                mobileForm.submit();
            },
        }
    }
</script>

<style scoped>

</style>