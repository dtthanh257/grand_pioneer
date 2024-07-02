import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class LocationService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyage-locations",
    });
  }
  async getDataByVoyage(voyage_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-locations",
    });
  }

  async getDataById(voyage_id, location_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-locations/" + location_id,
    });
  }

  async storeData(activity, voyage_id) {
    return await axios.post(
      BASE_API_URL + "/voyages/" + voyage_id + "/voyage-locations",
      activity,
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(location_id, voyage_id, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-locations/" + location_id,
      data: data,
      headers: authHeader(),
    });
  }

  async deleteData(location_id, voyage_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-locations/" + location_id,
      headers: authHeader(),
    });
  }
}

export default new LocationService();
