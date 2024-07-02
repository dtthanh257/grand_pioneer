import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class TimelineService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyage-timeline",
    });
  }
  async getDataByVoyage(voyage_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-timeline",
    });
  }

  async getDataById(voyage_id, timeline_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-timeline/" + timeline_id,
    });
  }

  async storeData(timeline, voyage_id) {
    return await axios.post(BASE_API_URL + "/voyages/" + voyage_id + "/voyage-timeline", timeline, {
      headers: authHeader(),
    });
  }

  async updateData(timeline_id, voyage_id, timeline) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-timeline/" + timeline_id,
      data: timeline,
      headers: authHeader(),
    });
  }

  async deleteData(timeline_id, voyage_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-timeline/" + timeline_id,
      headers: authHeader(),
    });
  }
}

export default new TimelineService();
