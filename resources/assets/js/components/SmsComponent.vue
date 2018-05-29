<template>
    <div>
        <div class="form-group row">
            <div v-if="registered" class="alert alert-danger col-md-6 offset-md-4" role="alert">
                该手机号已被注册!
            </div>
            <div v-if="success" class="alert alert-success col-md-6 offset-md-4" role="alert">
                验证码已发送，请注意查收。
            </div>
            <label for="phone-number" class="col-md-4 col-form-label text-md-right">请输入手机号</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input id="phone-number" type="tel" v-bind:class="this.showMobileError ? 'is-invalid' : '' " class="form-control" v-model="strMobile" name="mobile" required>
                    <div class="input-group-append">
                        <button id="sendVerifySmsButton" :disabled="sendMsgDisabled" type="button" class="btn btn-primary" @click="send">
                            <span v-if="sendMsgDisabled">{{countDown+'秒后获取'}}</span>
                            <span v-if="!sendMsgDisabled">发送验证码</span>
                        </button>
                    </div>
                </div>
                <span class="invalid-feedback" v-show="this.showMobileError" style="display: block">
                    <strong>{{ this.mobileErrorMessage }}</strong>
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="v-code" class="col-md-4 col-form-label text-md-right">请输入验证码</label>
            <div class="col-md-6">
                <input id="v-code" type="number" v-bind:class="this.showCodeError ? 'is-invalid' : '' "  class="form-control" name="vcode" required>
                <span class="invalid-feedback" v-show="this.showCodeError" style="display: block">
                    <strong>{{ this.codeErrorMessage }}</strong>
                </span>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button @click="submit" class="btn btn-primary mr-4" v-bind:disabled="registerDisabled">
                    注册
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sms-component",
        props: ['showMobileError', 'mobileErrorMessage', 'showCodeError', 'codeErrorMessage'],
        data() {
            return {
                strMobile: undefined,
                registered: false,
                registerDisabled: false,
                success: false,
                sig: "",
                urlRandom: 0,
                time: 0,
                countDown: 30, // 发送验证码倒计时
                sendMsgDisabled: false,
            }
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
                        _this.registered = false;
                        _this.registerDisabled = false;
                        _this.success = true;
                        _this.changeButton();
                    },function(response){
                        // console.log(response.status);
                        // console.log(response.body);
                        _this.registered = true;
                        _this.registerDisabled = true;
                        _this.sucess = false;
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
                let timer = setInterval(function() {
                    if(_this.countDown > 0) {
                        _this.countDown--;
                    }
                    else{
                        _this.sendMsgDisabled = false;
                        window.clearInterval(timer);
                    }
                }, 1000);
            },
            submit(){
                mobileForm.submit();
            },
        }
    }
</script>

<style scoped>

</style>