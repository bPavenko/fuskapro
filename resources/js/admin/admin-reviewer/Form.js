import AppForm from '../app-components/Form/AppForm';

Vue.component('admin-reviewer-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name: '',
                profession: '',
                review: '',
                avatar: null
            }
        }
    },
    methods:{
        selectFile(event) {
            // `files` is always an array because the file input may be in multiple mode
            console.log(event.target.files[0])
            this.form.avatar = event.target.files[0];
            console.log(this.form.avatar)
        },
        submitForm(e) {
            console.log()
        }
    }

});