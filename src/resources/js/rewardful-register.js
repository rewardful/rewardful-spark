module.exports = {
    mounted(){
        window.addEventListener('Rewardful.tracked', () => {
            if(this.$options.name === 'spark-register-stripe')
                this.registerForm.referral = Rewardful.referral
            if(this.$options.name === 'spark-subscribe-stripe')
                this.form.referral = Rewardful.referral
          });
    }
}