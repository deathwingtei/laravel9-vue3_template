<template>
    <div>
        <h2>Welcome to Laravel 9 With Vue Template (with laravel route)</h2>
        <h3>Click On Content for edit Content index page</h3>
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