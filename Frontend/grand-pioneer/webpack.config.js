const { DefinePlugin } = require("webpack");

module.exports = {
  // other webpack configurations
  plugins: [
    new DefinePlugin({
      __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: JSON.stringify(true), // Define the feature flag
    }),
  ],
};
