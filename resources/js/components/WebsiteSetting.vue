<template>
    <div>
        <h2>Welcome to Laravel 9 With Vue Template (with laravel route)</h2>
        <h3>Click On Content for edit Content index page</h3>
    </div>
</template>

<script>
    export default {
        name: 'WebsiteSetting',
        data(){
            return {

            }
        },
        mounted(){
            console.log('Component mounted.');
            //this.fetchArticles('/local/articles');
        },
        created(){
            console.log('Component created.');
            //this.fetchArticles('/local/articles');
        },
        methods: {
            
        }
    }
</script>