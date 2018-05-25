<template>
    <div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">请输入邮箱地址</label>
            <div class="col-md-6">
                <div class="input-group">
                    <input id="email" type="email" v-bind:class="this.showEmailError ? 'is-invalid' : '' " class="form-control" v-model="strEmail" name="email" required>
                    <div class="input-group-append">
                        <button id="sendVerifySmsButton" class="btn btn-primary btn-md" @click="send">发送验证码</button>
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
                <button @click="submit" class="btn btn-primary mr-4">
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
            }
        },
        methods: {
            send() {
                this.$http.post("/api/mail/send", {
                    'address':this.strEmail,
                }).then(function(response){
                        console.log(response.status)
                    },function(response){
                        console.log(response.status);
                        console.log(response.body);
                    }
                );
            },
            submit(){
                mailForm.submit();
            },
        }
    }
</script>

<style scoped>

</style>