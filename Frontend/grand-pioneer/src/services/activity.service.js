import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class ActivityService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/activities",
    });
  }
  async getDataByVoyage(voyage_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/activities",
    });
  }

  async getDataById(voyage_id, activity_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/activities/" + activity_id,
    });
  }

  async storeData(activity, voyage_id) {
    return await axios.post(BASE_API_URL + "/voyages/" + voyage_id + "/activities", activity, {
      headers: authHeader(),
    });
  }

  async updateData(activity_id, voyage_id, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/activities/" + activity_id,
      data: data,
      headers: authHeader(),
    });
  }

  async deleteData(activity_id, voyage_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/activities/" + activity_id,
      headers: authHeader(),
    });
  }
}

export default new ActivityService();
