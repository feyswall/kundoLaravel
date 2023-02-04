<template>
    <div>
        <table id="allSmsTable" class="table table-striped table-bordered dt-responsive nowrap"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Group No_</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>phone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="smsLeader in smsWithLeaders">
                    <td v-if="smsLeader.status == 'DELIVERED'" class="text-success"><b>{{ smsLeader.status }}</b></td>
                    <td v-if="smsLeader.status == 'PENDING'" class="text-primary"><b>{{ smsLeader.status }}</b></td>
                    <td v-if="smsLeader.status == 'FAILED'" class="text-danger"><b>{{ smsLeader.status }}</b></td>
                    <td>{{ sms }}</td>
                    <td>{{ smsLeader.leader.firstName }}</td>
                    <td>{{ smsLeader.leader.lastName }}</td>
                    <td>{{  smsLeader.leader.phone }}</td>
                    <td>
                        <a href="" class="btn btn-danger btn-sm">delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    props: ['sms', 'request_id'],
    data() {
        return {
            smsWithLeaders: [],
            status: {},
        }
    },
    mounted() {
        this.loadSmsOfGroup();
    },
    methods: {
            loadSmsOfGroup() {
            const obj = this;
            axios.get(`/api/super/sms/group/orodha/${this.sms}`)
                .then((response) => {
                    let responseData = Array;
                    if (response.data) {
                        responseData = response.data;
                        this.smsWithLeaders = responseData;
                    }
                })
                .catch(function (error) {
                    alert(error);
                });
        },
        loadSmsStatus(leader, request_id) {
            axios.get(`/api/super/sms/status/${leader.phone}/${request_id}`)
                .then((response) => {
                    let responseData = Array;
                    if (response.data) {
                        responseData = response.data;
                        if (responseData.status == 'success') {
                            console.log(responseData);
                       }
                    }
                })
                .catch(function (error) {
                    alert(error);
                });
            }
    }
}

</script>