<template>
    <div>
        <button @click="removeCookie">Remove Browser Cookie</button>

        <vue-cookie-accept-decline
            :ref="'myPanel1'"
            :elementId="'myPanel1'"
            :debug="false"
            :position="'bottom-center'"
            :type="'floating'"
            :disableDecline="true"
            :transitionName="'slideFromBottom'"
            @status="cookieStatus"
            @clickedAccept="cookieClickedAccept"
            @removedCookie="cookieRemovedCookie">

            <!-- Optional -->
            <div slot="message">
                We use cookies to ensure you get the best experience on our website. <a href="https://cookiesandyou.com/" target="_blank">Learn More...</a>
            </div>

            <!-- Optional -->
            <div slot="acceptContent">
                GOT IT!
            </div>
        </vue-cookie-accept-decline>
    </div>
</template>

<script>
export default {
    data () {
        return {
            status: null
        }
    },
    methods: {
        cookieStatus (status) {
            console.log('status: ' + status)
            this.status = status
        },
        cookieClickedAccept () {
            console.log('here in accept')
            this.status = 'accept'
        },
        cookieRemovedCookie () {
            console.log('here in cookieRemoved')
            this.status = null
            this.$refs.myPanel1.init()
        },

        removeCookie () {
            console.log('Cookie removed')
            this.$refs.myPanel1.removeCookie()
        }
    },
    computed: {
        statusText () {
            return this.status || 'No cookie set'
        }
    }
}
</script>

<style scoped lang="scss">
.cookie {
    &__floating {
        @media (min-width: 768px) {
            max-width: 100% ;
        }
    }
}
</style>
