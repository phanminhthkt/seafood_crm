<template>
    <div id="main">
        <Header></Header>
        <Messages></Messages>
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </div>
        </div>    
        <Footer></Footer>
    </div>    
</template>

<script>
    import Header from './HeaderComponent.vue'
    import Messages from './MessagesComponent.vue'
    import Footer from './FooterComponent.vue'
    export default {
        data() {
            return{
                
            }
        },
        components: {
            Header,
            Messages,
            Footer
        }
    }
</script>
<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0;
    }
    .modal-enter {
      opacity: 0;
    }

    .modal-leave-active {
      opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }
</style>