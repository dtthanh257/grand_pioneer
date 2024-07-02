import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class SuiteMetadataService {
  async getData(suite_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/suites/" + suite_id + "/suite-metadata",
    });
  }

  async getDataById(suite_id, suite_metadata_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/suites/" + suite_id + "/suite-metadata/" + suite_metadata_id,
    });
  }

  async storeData(suite_id, image_link) {
    return await axios.post(
      BASE_API_URL + "/suites/" + suite_id + "/suite-metadata",
      { image_link: image_link },
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(suite_metadata_id, suite_id, voyage) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/suites/" + suite_id + "/suite-metadata/" + suite_metadata_id,
      voyage,
      headers: authHeader(),
    });
  }

  async deleteData(suite_metadata_id, suite_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/suites/" + suite_id + "/suite-metadata/" + suite_metadata_id,
      headers: authHeader(),
    });
  }
}

export default new SuiteMetadataService();
