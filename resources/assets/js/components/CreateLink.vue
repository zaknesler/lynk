<template>
    <div>
        <div class="heading">Lynk</div>

        <div class="message" v-html="message"></div>

        <div class="body">
            <form class="form" @submit.prevent="createLink">
                <div class="form-group" :class="{'has-error': errors.url}">
                    <input type="url" class="form-input" v-model="input.url" placeholder="Enter a url..." required />

                    <div class="form-error" v-if="errors.url">{{ errors.url[0] }}</div>
                </div>

                <div class="form-group" :class="{'has-error': errors.code}">
                    <input type="code" class="form-input" v-model="input.code" placeholder="Enter an optional code..." />

                    <div class="form-error" v-if="errors.code">{{ errors.code[0] }}</div>
                </div>

                <div class="form-group">
                    <button type="submit" class="button">Shorten</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: 'Shorten urls easily',

                input: {
                    url: null,
                    code: null
                },

                errors: {},

                response: {}
            }
        },

        methods: {
            createLink() {
                this.errors = [];

                this.$http
                    .post('/api/links', this.input)
                    .then((response) => {
                        this.response = response.data;

                        this.message = 'Your shortened url: <a href="' + this.response.shortened_url + '">lynk.ml/' + this.response.code + '</a>'

                        this.input.url = null;
                        this.input.code = null;
                    })
                    .catch((error) => {
                        this.response = error.response.data;
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>
