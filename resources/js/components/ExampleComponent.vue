<template>
    <div>
        <p>チャットルーム：{{ chatroomId }}</p>
        <ul>
            <li v-for="(message, key) in messages" :key="key">
                <strong>{{ message.user.name }}</strong>
                {{ message.message }}
            </li>
        </ul>
        <input v-model="text" />
        <button @click="postMessage" :disabled="!textExists">送信</button>
    </div>
</template>
 
<script>
export default {
    props: {
        chatroomId: {
            type: Number,    
        },
    },
    data() {
        return {
            text: "",
            messages: []
        };
    },
    computed: {
        textExists() {
            return this.text.length > 0;
        }
    },
    created() {
        this.fetchMessages();
        
        Echo.private("chat."+this.chatroomId).listen("MessageSent", e => {
            this.messages.push({
                message: e.message.message,
                user: e.user,
                chatroomId: e.chatroomId
            });
        });
    },
    methods: {
        fetchMessages(chatroomId) {
            axios.get("/messages", { params: {chatroomId: this.chatroomId} }).then(response => {
                this.messages = response.data;
            });
        },
        postMessage(message,chatroomId) {
            axios.post("/messages", { 
                message: this.text, 
                chatroomId: this.chatroomId ,
            }).then(response => {
                this.text = "";
            });
        }
    }
};
</script>