<template>
    <div>
        <div class="ul-body"　id="list">
            <div v-for="(message, key) in messages" :key="key" class="li-body">
                <div v-if="userId === message.user.id" class="my-message">
                    <div class="message-body mine">{{ message.message }}</div><br>
                    <div class="message-name mine">{{ message.user.name}}</div><br>
                </div>
                <div v-if="userId !== message.user.id" class="other-message">
                    <div class="message-body other">{{ message.message }}</div><br>
                    <div class="message-name ">{{ message.user.name}}</div><br>
                </div>
            </div>
        </div>
        <div class="input-form">
            <div class="input-form-block">
                <input class="input" v-model="text" />
                <button @click="postMessage" :disabled="!textExists">送信</button>
                
            </div>
        </div>
    </div>
</template>
 
<script>
export default {
    props: {
        chatroomId: {
            type: Number,    
        },
        userId: {
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
        },
    },
    mounted() {
        this.fetchMessages();
        
        Echo.private("chat."+this.chatroomId).listen("MessageSent", e => {
            this.messages.push({
                message: e.message.message,
                user: e.user,
                chatroomId: e.chatroomId
            });
        });
    },
    updated() {
        this.pageScroll();
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
        },
        pageScroll(){
            const obj = document.getElementById('list');
            console.log(obj.scrollHeight);
            obj.scrollTop = obj.scrollHeight;
        }
    }
};
</script>