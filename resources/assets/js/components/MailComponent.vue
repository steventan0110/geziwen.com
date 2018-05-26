<template>
    <div>
        <div class="form-group row">
            <div v-if="registered" class="alert alert-danger col-md-6 offset-md-4" role="alert">
                该邮箱地址已被注册!
            </div>
            <div v-if="success" class="alert alert-success col-md-6 offset-md-4" role="alert">
                验证码已发送，请注意查收。
            </div>
            <label for="email" class="col-md-4 col-form-label text-md-right">请输入邮箱地址</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input id="email" type="email" v-bind:class="this.showEmailError ? 'is-invalid' : '' " class="form-control" v-model="strEmail" name="email" required>
                    <div class="input-group-append">
                        <button id="sendVerifySmsButton" :disabled="sendMsgDisabled" type="button" class="btn btn-primary" @click="send">
                            <span v-if="sendMsgDisabled">{{countDown+'秒后获取'}}</span>
                            <span v-if="!sendMsgDisabled">发送验证码</span>
                        </button>
                    </div>
                </div>
                <span class="invalid-feedback" v-show="this.showEmailError" style="display: block">
                    <strong>{{ this.emailErrorMessage }}</strong>
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
        name: "mail-component",
        props: ['showEmailError', 'emailErrorMessage', 'showCodeError', 'codeErrorMessage'],
        data() {
            return{
                strEmail:"",
                registered: false,
                registerDisabled: false,
                success: false,
                countDown: 30, // 发送验证码倒计时
                sendMsgDisabled: false,
            }
        },
        methods: {
            send() {
                this.countDown = 30;
                let _this = this;
                this.$http.post("/api/mail/send", {
                    'address':this.strEmail,
                }).then(function(response){
                        // console.log(response.status);
                        // console.log(response.body);
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
                mailForm.submit();
            },
        }
    }
</script>

<style scoped>

</style>