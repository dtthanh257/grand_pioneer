const moment = require("moment");

export const diffDate = (end_date, start_date) => {
  let date1 = moment(end_date);
  let date2 = moment(start_date);

  return date2.diff(date1, "NIGHTS");
};
