<template>
    <div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">请输入邮箱地址</label>
            <div class="col-md-6">
                <div class="input">
                    <input id="email" type="email" v-bind:class="registered ? 'is-invalid' : '' " class="form-control" v-model="strEmail" name="email" required>
                </div>
                <span class="invalid-feedback" v-show="registered" style="display: block">
                    <strong>该邮箱已被注册</strong>
                </span>
                <span class="text-success" v-show="success" style="display: block">
                    <strong>验证码已发送，请注意查收</strong>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label for="email-vcode" class="col-md-4 col-form-label text-md-right">请输入验证码</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input id="email-vcode" type="number" v-bind:class="this.showCodeError ? 'is-invalid' : '' "  class="form-control" name="vcode" required>
                    <div class="input-group-append">
                        <button id="sendVerifyEmailButton" :disabled="sendDisabled" type="button" class="btn btn-primary" @click="send">
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
        name: "mail-component",
        props: ['showCodeError', 'codeErrorMessage'],
        data() {
            return{
                strEmail: "",
                registered: false,
                registerDisabled: false,
                success: false,
                countDown: 30, // 发送验证码倒计时
                sendMsgDisabled: false,
                sendDisabled: true,
            }
        },
        watch: {
            strEmail: function(){
                this.debouncedGetEmail();
            }
        },
        created: function () {
            // `_.debounce` 是一个通过 Lodash 限制操作频率的函数。
            // 参考：https://lodash.com/docs#debounce
            this.debouncedGetEmail = _.debounce(this.validate, 500)
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
                        _this.success = true;
                        _this.changeButton();
                    },function(response){
                        // console.log(response.status);
                        // console.log(response.body);
                        _this.success = false;
                    }
                );
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
                if(this.strEmail == ""){
                    _this.registered = false;
                    _this.sendDisabled = true;
                }
                else {
                    this.$http.post("/api/mail/test", {
                        'address': this.strEmail,
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
                mailForm.submit();
            },
        }
    }
</script>

<style scoped>

</style>