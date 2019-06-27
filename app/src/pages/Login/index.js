import React, { Component } from 'react';
import {
  View,
  Text,
  TextInput,
  StyleSheet,
  TouchableOpacity,
  ImageBackground,
  Keyboard,
  ActivityIndicator,
  PermissionsAndroid,
  Image
} from 'react-native';
import AsyncStorage from '@react-native-community/async-storage';
import Toast from 'react-native-simple-toast';
import api from '../../services/api';

import logo from '../../assets/logo.png';

class Login extends Component {

  constructor(props) {
    super(props);
    this.state = {
      user: 'priscila.silva',
      password: '12345678',
      loading: false,
      permissions: false,
    }
  }

  static navigationOptions = {
    header: null
  };

  componentDidMount() {
    this.requestPermissions();
    this.getUserInfo();
  }

  getUserInfo = async () => {
    const user = await AsyncStorage.getItem('@HackaPonto:user');
    const password = await AsyncStorage.getItem('@HackaPonto:password');

    if (user && password)
      this.authenticate(user, password);
  }

  setUserInfo = async (user, password) => {
    await AsyncStorage.setItem('@HackaPonto:user', user.usuario);
    await AsyncStorage.setItem('@HackaPonto:password', password);
  }

  authenticate = async (user, password) => {
    Keyboard.dismiss();

    try {

      this.setState({ loading: true });

      const response = await api.post('/login', { usuario: user, password });
      if (response.data.user) {
        if (this.state.permissions) {
          this.setUserInfo(response.data.user, password);
          this.props.navigation.navigate('Main', { user: response.data.user });
        } else {
          Toast.showWithGravity('Acesso negado por falta de permissões!', Toast.SHORT, Toast.BOTTOM);
        }
        this.setState({ loading: false });
      } else {
        Toast.showWithGravity('Erro ao logar', Toast.LONG, Toast.BOTTOM);
        this.setState({ loading: false });
      }

    } catch (error) {
      await AsyncStorage.removeItem('@HackaPonto:user');
      await AsyncStorage.removeItem("@HackaPonto:password");
      Toast.showWithGravity(error.message, Toast.LONG, Toast.BOTTOM);
      this.setState({ loading: false });
    }

  }

  requestPermissions = async () => {

    try {

      const location = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.ACCESS_FINE_LOCATION);

      const camera = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.CAMERA);

      const audio = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.RECORD_AUDIO);


      if (location === PermissionsAndroid.RESULTS.GRANTED &&
        camera === PermissionsAndroid.RESULTS.GRANTED &&
        audio === PermissionsAndroid.RESULTS.GRANTED) {

        this.setState({ permissions: true });
        return;
      }

      this.setState({ permissions: false });

    } catch (err) {
      this.setState({ permissions: false });
    }
  }

  render() {
    return (
      <ImageBackground
        source={{ uri: 'https://s3-sa-east-1.amazonaws.com/rocketseat-cdn/background.png' }}
        style={styles.container}
        resizeMode="cover"
      >

        <View style={styles.titleContainer}>
          <Image source={logo} />
        </View>

        <TextInput
          style={styles.inputContainer}
          ref={(input) => this.username = input}
          onChangeText={(user) => this.setState({ user })}
          value={this.state.user}
          placeholder='Usuário'
          placeholderTextColor='#999'
          selectionColor='#FFF'
          autoCorrect={false}
          autoCapitalize="none"
          onSubmitEditing={() => this.password.focus()}
        />
        <TextInput
          style={styles.inputContainer}
          placeholder='Senha'
          autoCorrect={false}
          autoCapitalize="none"
          secureTextEntry={true}
          selectionColor='#FFF'
          placeholderTextColor='#999'
          ref={(input) => this.password = input}
          onChangeText={(password) => this.setState({ password })}
          value={this.state.password}
        />

        <TouchableOpacity
          style={styles.button}
          onPress={() => this.authenticate(this.state.user, this.state.password)}>
          <Text style={styles.buttonText}>Entrar</Text>
        </TouchableOpacity>

        {
          this.state.loading &&
          <View style={{ marginTop: 20 }}>
            <ActivityIndicator
              animating={true}
              color='#FFF'
              size={'large'}
            />
          </View>
        }


      </ImageBackground >
    );
  }

}

const styles = StyleSheet.create({
  container: {
    alignItems: 'center',
    padding: 20,
    flex: 1,
  },
  titleContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 30,
    marginBottom: 80
  },
  title: {
    fontSize: 34,
    fontFamily: 'serif',
    color: '#FFF',
    fontWeight: 'bold',
    marginLeft: 5
  },
  inputContainer: {
    width: '90%',
    backgroundColor: '#fff',
    borderRadius: 5,
    paddingHorizontal: 16,
    fontSize: 16,
    color: '#333',
    marginVertical: 10,
  },
  button: {
    backgroundColor: '#6bd4c1',
    width: '90%',
    borderRadius: 5,
    marginTop: 100,
    paddingVertical: 12,
  },
  buttonText: {
    fontSize: 18,
    fontWeight: '500',
    color: '#fff',
    textAlign: 'center',
  },
});

export default Login;
