<template>
    <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-info mb-2">
        <div class="container">
            <a href="#" class="navbar-brand">Logo</a>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'Navbar',
        data() {
            return {
                title: 'Vue Test'
            }
        },
        created() {
            console.log('Created.')
        },
        mounted() {
            console.log('Component mounted.')
        },
        beforeDestroy() {
            console.log('Befor Destroy.')
        },
        methods: {
            hello: function(){
                alert("Hello");
            },
            myAlert() {
                alert("Alert");
            }
        }
    }
</script>
