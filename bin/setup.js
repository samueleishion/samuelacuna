const fs = require('fs')

ENV_DEFAULTS = {
  REACT_APP_GOOGLE_ANALYTICS_ID: 'G-XXXXXXX'
}

// Create .env file with default values if it doesn't exist
if (
  (process.argv.indexOf('-f') > 0) && (process.argv.indexOf('--force') > 0) ||
  !fs.existsSync('.env')
) {
  fs.writeFileSync('.env', Object.entries(ENV_DEFAULTS).map(([key, value]) => `${key}=${value}`).join('\n'))
}