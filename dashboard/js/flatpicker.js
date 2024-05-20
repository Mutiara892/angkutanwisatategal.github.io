// const flatpickr = require("flatpickr");
$(".basic-datepicker").flatpickr({
  disable: [
    function (date) {
      // return true to disable
      return !(date.getDay() === 0 || date.getDay() === 6);
    },
  ],
  locale: {
    firstDayOfWeek: 1, // start week on Monday
  },
});
