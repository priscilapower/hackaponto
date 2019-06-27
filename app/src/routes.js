import { createAppContainer, createStackNavigator } from 'react-navigation';

import Login from '~/pages/Login';
import Main from '~/pages/Main';
import Camera from '~/pages/Camera';
import Instituicao from '~/pages/Instituicao';
import Relatorio from '~/pages/Relatorio';

const Routes = createAppContainer(createStackNavigator({
  Login,
  Main,
  Camera,
  Instituicao,
  Relatorio
}, {
    initialRouteName: 'Login',
  })
);

export default Routes;
