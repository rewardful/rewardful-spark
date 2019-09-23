module.exports = {
    mounted(){
        if(typeof(Rewardful) != "undefined"  && Rewardful.referral!==''){
            this.setReferral();
        }
        addEventListener('Rewardful.tracked', () => {
            this.setReferral();
          });
    },
    methods:{
        setReferral (){
            if(this.$options.name === 'spark-register-stripe')
            {
                this.registerForm.referral = Rewardful.referral
            }
            if(this.$options.name === 'spark-subscribe-stripe')
            {
                this.form.referral = Rewardful.referral
            }
        }
    }
}