var waitingApp = new Vue({
  el: '#patientWaitingApp',
  data: {
    patients: []
  },
  methods: {
    fetchPatients() {
      fetch('dummy.php')
      .then(response => response.json())
      .then(json => { waitingApp.patients = json })
    },
    formatVisitDateLocal(d) {
      return moment.utc(d).local().format("HH:mm MMM Do");
    }
  },
  created() {
    this.fetchPatients();
  }
});
