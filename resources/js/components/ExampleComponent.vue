<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{title}}</div>

                    <div class="card-body">
                        I'm an example component.
                        <button @click="myAlert">Alert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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
