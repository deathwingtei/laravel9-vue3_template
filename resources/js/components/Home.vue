<template>
    <div>
        <h2>Home</h2>
        
    </div>
</template>

<script>
    export default {
        name: 'Home',
        data(){
            return {

            }
        },
        mounted(){
            console.log('Component mounted.');
            //this.fetchArticles('/api/articles');
        },
        created(){
            console.log('Component created.');
            //this.fetchArticles('/api/articles');
        },
        methods: {
            
        }
    }
</script>