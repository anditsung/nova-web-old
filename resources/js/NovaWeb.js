import Vue from 'vue'
import Toasted from 'vue-toasted'
import axios from './util/axios'
import Loading from 'nova/components/Loading'

Vue.use(Toasted, {
    theme: 'nova',
    position: 'bottom-right',
    duration: 6000
})

export default class NovaWeb {
    constructor(config) {
        this.bus = new Vue()
        this.config = config
    }

    liftOff() {
        let _this = this

        this.app = new Vue({
            el: '#novaweb',
            components: { Loading },
            mounted: function () {
                this.$loading = this.$refs.loading

                _this.$on('error', message => {
                    this.$toasted.show(message, { type: 'error' })
                })

                _this.$on('token-expired', () => {
                    this.$toasted.show(this.__('Sorry, your session has expired.'), {
                        action: {
                            onClick: () => location.reload(),
                            text: this.__('Reload'),
                        },
                        duration: null,
                        type: 'error',
                    })
                })
            }
        })
    }

    /**
     * Return an axios instance configured to make requests to Nova's API
     * and handle certain response codes.
     */
    request(options) {
        if (options !== undefined) {
            return axios(options)
        }

        return axios
    }

    /**
     * Register a listener on Nova's built-in event bus
     */
    $on(...args) {
        this.bus.$on(...args)
    }

    /**
     * Register a one-time listener on the event bus
     */
    $once(...args) {
        this.bus.$once(...args)
    }

    /**
     * Unregister an listener on the event bus
     */
    $off(...args) {
        this.bus.$off(...args)
    }

    /**
     * Emit an event on the event bus
     */
    $emit(...args) {
        this.bus.$emit(...args)
    }

    /**
     * Determine if Nova is missing the requested resource with the given uri key
     */
    missingResource(uriKey) {
        return _.find(this.config.resources, r => r.uriKey == uriKey) == undefined
    }

    /**
     * Show an error message to the user.
     *
     * @param {string} message
     */
    error(message) {
        Vue.toasted.show(message, { type: 'error' })
    }

    /**
     * Show a success message to the user.
     *
     * @param {string} message
     */
    success(message) {
        Vue.toasted.show(message, { type: 'success' })
    }

    /**
     * Register a keyboard shortcut.
     */
    addShortcut(keys, callback) {
        Mousetrap.bind(keys, callback)
    }

    /**
     * Unbind a keyboard shortcut.
     */
    removeShortcut(keys) {
        Mousetrap.unbind(keys)
    }
}
