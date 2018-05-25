<template>
    <div>
        <div class="form-group row">
            <label for="phone-number" class="col-md-4 col-form-label text-md-right">请输入手机号</label>
            <div class="col-md-6">
                <input id="phone-number" type="tel" class="form-control" v-model="strMobile" name="mobile" required>
                <span class="invalid-feedback" v-show="this.showMobileError" style="display: block">
                    <strong>{{ this.mobileErrorMessage }}</strong>
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="v-code" class="col-md-4 col-form-label text-md-right">请输入验证码</label>
            <div class="col-md-6">
                <input id="v-code" type="number"  class="form-control" name="vcode" required>
                <span class="invalid-feedback" v-show="this.showCodeError" style="display: block">
                    <strong>{{ this.codeErrorMessage }}</strong>
                </span>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary mr-4">
                    注册
                </button>
                <button id="sendVerifySmsButton" :disabled="sendMsgDisabled" class="btn btn-success btn-md" @click="send">
                    <span v-if="sendMsgDisabled">{{countDown+'秒后获取'}}</span>
                    <span v-if="!sendMsgDisabled">发送验证码</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "sms-component",
        // props: {
        //     showMobileError: {
        //         type: Boolean,
        //         // default: false
        //     },
        //     mobileErrorMessage: {
        //         type: String
        //     },
        //     showCodeError: {
        //         type: Boolean,
        //         // default: false
        //     },
        //     codeErrorMessage: {
        //         type: String
        //     }
        // },
        props: ['showMobileError', 'mobileErrorMessage', 'showCodeError', 'codeErrorMessage'],
        data() {
            return {
                strMobile: undefined,
                sig: "",
                urlRandom: 0,
                time: 0,
                countDown: 30, // 发送验证码倒计时
                sendMsgDisabled: false,
            }
        },
        methods: {
            send() {
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
                        console.log(response.status)
                    },function(response){
                        console.log(response.status);
                        console.log(response.body);
                    }
                );
                this.changeButton();
            },
            generate() {
                for(var i=0;i<4;i++){
                    this.urlRandom+=parseInt(Math.random()*Math.pow(10,i));
                }
            },
            changeButton() {
                let me = this;
                me.sendMsgDisabled = true;
                let timer = setInterval(function() {
                    if(me.countDown > 0) {
                        me.countDown--;
                    }
                    else{
                        me.sendMsgDisabled = false;
                        window.clearInterval(timer);
                    }
                }, 1000);
            },
        }
    }
</script>

<style scoped>

</style>