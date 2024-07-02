import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class Admin {
  //User Api
  async getUserData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/users",
      headers: authHeader(),
    });
  }
  async deleteUser(id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/users/" + `${id}`,
      headers: authHeader(),
    });
  }
  async updateUser(id, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/users/" + `${id}`,
      headers: authHeader(),
      data: data,
    });
  }
  //Vessel Api
  async getVesselData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels",
      headers: authHeader(),
    });
  }
  async addVessel(data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/vessels",
      data: data,
      headers: authHeader(),
    });
  }
  async deleteVessel(id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + `${id}`,
      headers: authHeader(),
    });
  }
  //Suite Api

  async getSuiteData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/suites",
      headers: authHeader(),
    });
  }
  async deleteSuite(vesselId, id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + `${vesselId}` + "/suites/" + `${id}`,
      headers: authHeader(),
    });
  }
  async addSuite(vesselId, data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/vessels/" + `${vesselId}` + "/suites/",
      headers: authHeader(),
      data: data,
    });
  }
  async updateSuite(vesselId, id, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + `${vesselId}` + "/suites/" + `${id}`,
      headers: authHeader(),
      data: data,
    });
  }

  //Voyages Api
  async getVoyageByVessel(id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + id + "/voyages",
    });
  }
  async deleteVoyage(vesselsId, voyagesId) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + `${vesselsId}` + "/voyages/" + `${voyagesId}`,
      headers: authHeader(),
    });
  }
  async updateVoyage(vesselsId, voyagesId, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + `${vesselsId}` + "/voyages/" + `${voyagesId}`,
      headers: authHeader(),
      data: data,
    });
  }

  async deleteDateAvail(voyage_id, voyage_date_id) {
    return await axios({
      method: "delete",
      url:
        BASE_API_URL +
        "/voyages/" +
        `${voyage_id}` +
        "/voyage-date-available/" +
        `${voyage_date_id}`,
      headers: authHeader(),
    });
  }
  async addDateAvail(voyage_id, data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/voyages/" + `${voyage_id}` + "/voyage-date-available/",
      headers: authHeader(),
      data: data,
    });
  }
  async deleteTimeline(voyage_id, timeline_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + `${voyage_id}` + "/voyage-timeline/" + `${timeline_id}`,
      headers: authHeader(),
    });
  }
  async addTimeline(voyage_id, data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/voyages/" + `${voyage_id}` + "/voyage-timeline/",
      headers: authHeader(),
      data: data,
    });
  }
  async deleteActivity(voyage_id, activity_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + `${voyage_id}` + "/activities/" + `${activity_id}`,
      headers: authHeader(),
    });
  }
  // Services api
  async getServiceByVessel(vesselsId) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/vessels/" + `${vesselsId}` + "/services",
      headers: authHeader(),
    });
  }
  async deleteService(vesselsId, serviceId) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/vessels/" + `${vesselsId}` + "/services/" + `${serviceId}`,
      headers: authHeader(),
    });
  }
  async addService(vesselsId, data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/vessels/" + `${vesselsId}` + "/services",
      headers: authHeader(),
      data: data,
    });
  }
  async updateServiceById(vesselsId, serviceId, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/vessels/" + `${vesselsId}` + "/services/" + `${serviceId}`,
      headers: authHeader(),
      data: data,
    });
  }
  //Blogs Api
  async getBlog() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/posts/",
      headers: authHeader(),
    });
  }
  // async getSection(id) {
  //   return await axios({
  //     method: "get",
  //     url: BASE_API_URL + "/posts/" +`${}`,
  //     headers: authHeader(),
  //   });
  // }
}
export default new Admin();
