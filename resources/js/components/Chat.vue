<template>
<div class="col-md-8 col-11">
    <h2 class="display-5 text-center">Messaggi</h2>

    <div class="row justify-content-center">
        <div class="col-12 border rounded flex py-4 my-4" id="chat" ref="chat" style="background-image:url(https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png; background-position:center center; background-size:cover; height: 700px; overflow-y:auto">
            <div v-for="(message, index) in messages" :key="index" class="my-2 rounded d-block col-9 col-md-5 p-2 shadow-sm" :style="(current_user == message.user.id) ? 'margin-right:0; background:#DCF8C6; margin-left:auto;' : 'background:#DCF8C6;'">
                <h5 class="my-0"><span class="badge badge-info text-white my-0">{{ message.user.name }}</span></h5>
                <p class="lead mb-0" style="overflow-wrap: break-word;">{{ message.message }}</p>
                <p @click="hover = true" @mouseleave="hover = false" @touchmove="hover = false" class="text-secondary my-0"> {{ message.created_at.split("T")[1].slice(0, 8) }} <span v-if="!hover"><i class="bi bi-info-circle-fill pt-1" style="opacity:0.6"></i></span> <span v-if="hover">{{message.created_at.split('T')[0].slice(0, 10)}}</span> </p>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-check float-right" viewBox="0 0 16 18" style="opacity:.7; margin-left: -15px;margin-top: -19px;">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-check float-right" viewBox="0 0 16 18" style="opacity:.7;margin-top: -19px;">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
      </div>
        </div>
    </div>

    <div class="input-group">
        <textarea
            type="text"
            name="message"
            class="form-control"
            placeholder="Type your message here..."
            cols="18"
            rows="1"
            v-model="newMessage"
            @keyup.enter="sendMessage"
            style="border-radius: 500px 30px 30px 500px; padding:7px 40px 0 20px; margin-right:-30px;z-index:1; position:relative; margin-top:1px"
        >
        </textarea>

        <button
            class="btn btn-success px-2"
            @click="sendMessage"
            style="border-radius: 1000px; z-index:9; position:relative;"
        >
            <i class="bi bi-arrow-right-short d-flex" style="font-size: 30px"></i>
        </button>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            newMessage: '',
            hover: false
        }
    },
    props: {
        current_user: Number
    },

    created() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSentEvent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    created_at: e.message.created_at,
                    user: e.user
                });
            });
        
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            axios.post('/messages', {
                message
            }).then(response => {
                this.messages.push({
                    message: response.data.message.message,
                    created_at: response.data.message.created_at,
                    user: response.data.user
                });
                let container = this.$refs.chat;
                setTimeout(() => {if(container.scrollTop != container.scrollHeight) container.scrollTop = container.scrollHeight+200;}, 550);
            });
            
        },

        sendMessage() {
            this.addMessage(this.newMessage);
            this.newMessage = '';
        }
    }
}
</script>
