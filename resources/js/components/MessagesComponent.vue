<template>
    <transition name="fade">
      <div id="alert-container">
          <div class="alert alert-custom alert-danger alert-dismissible fade show" role="alert" v-if="errorList">
              <button class="close" @click.prevent="errorList = null" ><span aria-hidden="true">×</span></button>
              <ul>
                  <li v-for="(errorName, index) in errorList.errors" :key="index">
                      <i class="mdi mdi-block-helper mr-1"></i>{{ errorName[0] }}
                  </li>
              </ul>
          </div>

          <div 
              v-if="message"
              :class="{
                'alert alert-custom alert-danger alert-dismissible fade show': message.type === 'danger',
                'alert alert-custom alert-success alert-dismissible fade show': message.type === 'success',
                'alert alert-custom alert-warning alert-dismissible fade show': message.type === 'warning'
              }"
              role="alert" >
              <button type="button" class="close" @click.prevent="message = null"><span aria-hidden="true">×</span></button>
              <i 
                  :class="{
                    'mdi mdi-block-helper mr-1': message.type === 'danger',
                    'mdi mdi-check  mr-1': message.type === 'success',
                    'mdi mdi-alert-outline fade show mr-1': message.type === 'warning'
                  }"
                  class="mdi mdi-block-helper ">
                  
              </i>
              <span v-html="message.text"></span>
              <!-- {{ message.text }} -->
          </div>
      </div> 
    </transition>   
</template>

<script>
    export default {
      data() {
        return {
          message: null,
          errorList: null
        };
      },
      mounted() {
        this.$bus.on('flash-message', message => {
            this.message = message;
            setTimeout(() => {
              this.message = null;
            }, 5000);
        });
        this.$bus.on('flash-messages', errorList => {
            if(errorList.message){
              var error = {text:errorList.message,type:'danger'}
              this.message = error;
            }else{this.errorList = errorList;}
            setTimeout(() => {
              this.errorList = null;
              this.message = null;
            }, 5000);
        });
      
      }
    };
</script>
<style lang="scss" scoped>
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  .slide-fade-enter-active {
    transition: all .3s ease;
  }
  .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }
  .slide-fade-enter, .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
  }
</style>