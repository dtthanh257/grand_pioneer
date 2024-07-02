import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class ExperienceService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyage-experience",
    });
  }
  async getDataByVoyage(voyage_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-experience",
    });
  }

  async getDataById(voyage_id, experience_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-experience/" + experience_id,
    });
  }

  async storeData(experience, voyage_id) {
    return await axios.post(
      BASE_API_URL + "/voyages/" + voyage_id + "/voyage-experience",
      experience,
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(experience_id, voyage_id, experience) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-experience/" + experience_id,
      data: experience,
      headers: authHeader(),
    });
  }

  async deleteData(experience_id, voyage_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-experience/" + experience_id,
      headers: authHeader(),
    });
  }
}

export default new ExperienceService();
