import Axios from "axios"
import { mapGetters } from 'vuex'


export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj,
                    headers: {
                        'Bearer-Token': this.getUserToken
                    }

                });
            } catch (error) {
                return error.response
            }



        },
        // Notification Api
        toast(message, type) {
            Vue.$toast.open({
                message: message,
                type: type,
                // all of other options may go here
            });
        },
        toastError(message) {
            Vue.$toast.open({
                message: message,
                type: 'error',
                // all of other options may go here
            });
        },
        toastSuccess(message) {
            Vue.$toast.open({
                message: message,
                type: 'success',
                // all of other options may go here
            });
        },
        toastNoAccess() {
            Vue.$toast.open({
                message: 'You have no access to this function',
                type: 'info',
                // all of other options may go here
            });
        },
        toastFetchData() {
            Vue.$toast.open({
                message: 'Data fetched successfully',
                type: 'success',
                // all of other options may go here
            });
        },
        toastFetchDataError() {
            Vue.$toast.open({
                message: 'Error fetching Data !',
                type: 'error',
                // all of other options may go here
            });
        },


    },

    computed: {
        ...mapGetters([
            'getUserToken'
        ])
    }


}