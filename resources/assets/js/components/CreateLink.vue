<template>
    <form action="#" class="form" @submit.prevent="createLink">
        <div class="form-message">
            <span v-show="!response.code">
                Enter a URL to shorten and an optional code.
            </span>

            <span v-show="response.code">
                <a :href="'https://lynk.ml/' + response.code">
                    lynk.ml/{{ response.code }}
                </a>
            </span>
        </div>

        <div class="form-together">
            <div class="form-group" :class="errors.url ? 'has-error' : ''">
                <input type="url" v-model="input.url" class="form-input" placeholder="https://google.com" required autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />

                <div v-if="errors.url" class="form-error">
                    {{ errors.url[0] }}
                </div>
            </div>

            <div class="form-group" :class="errors.code ? 'has-error' : ''">
                <input type="text" v-model="input.code" class="form-input" minlength="2" maxlength="64" placeholder="google" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />

                <div v-if="errors.code" class="form-error">
                    {{ errors.code[0] }}
                </div>
            </div>
        </div>

        <button class="button">Shorten</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                input: {
                    url: '',
                    code: ''
                },

                errors: [],

                response: {}
            }
        },

        methods: {
            createLink() {
                this.errors = [];

                this.$http
                    .post('/links', this.input)
                    .then((response) => {
                        this.response = response.data;

                        this.input.url = '';
                        this.input.code = '';
                    }, (response) => {
                        this.errors = response.data;
                    });
            }
        }
    }
</script>
