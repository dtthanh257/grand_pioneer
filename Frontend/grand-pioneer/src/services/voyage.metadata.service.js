import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class VoyageMetadataService {
  async getData(voyage_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-metadata",
    });
  }

  async getDataById(voyage_id, voyage_metadata_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-metadata/" + voyage_metadata_id,
    });
  }

  async storeData(voyage_id, image_link) {
    return await axios.post(
      BASE_API_URL + "/voyages/" + voyage_id + "/voyage-metadata",
      { image_link: image_link },
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(voyage_metadata_id, voyage_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-metadata/" + voyage_metadata_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(voyage_metadata_id, voyage_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/voyages/" + voyage_id + "/voyage-metadata/" + voyage_metadata_id,
      headers: authHeader(),
    });
  }
}

export default new VoyageMetadataService();
