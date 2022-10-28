import data from './projects.json'; 

// Logos 
import VisaLogo from '../../assets/images/projects/visa-logo.svg'; 
import GulpAxeLogo from '../../assets/images/projects/gulpaxe-logo.png'; 
import PerspectiveLogo from '../../assets/images/projects/perspective-logo.svg'; 
import StockbotLogo from '../../assets/images/projects/robinhood-logo.png'; 

// Screenshots 
import PerspectiveScreenshot1 from '../../assets/images/projects/perspective-site-1.png';
import PerspectiveScreenshot2 from '../../assets/images/projects/perspective-site-2.png';
import PerspectiveScreenshot3 from '../../assets/images/projects/perspective-site-3.png'; 

const logoMap = {
  visa: VisaLogo,
  gulpaxe: GulpAxeLogo, 
  perspective: PerspectiveLogo,
  stockbot: StockbotLogo
}; 

const screenshotsMap = {
  1: PerspectiveScreenshot1,
  2: PerspectiveScreenshot2,
  3: PerspectiveScreenshot3
}; 

export default data.projects.map(x => {
  x.image.asset = logoMap[x.id]; 
  x.screenshots = x.screenshots.map((y, i) => {
    const key = parseInt(y.src.substring(y.src.lastIndexOf('-') + 1, y.src.lastIndexOf('.'))); 
    x.screenshots[i].asset = screenshotsMap[key]; 
    return x.screenshots[i];
  })
  return x;
});