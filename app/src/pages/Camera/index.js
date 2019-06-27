import React, { Component } from 'react';

import {
  View,
  StyleSheet,
  StatusBar,
  TouchableOpacity,
  Text,
  BackHandler,
  Alert,
  ActivityIndicator
} from 'react-native';

import Distance from '../../services/distance';
import api from '../../services/api';
import { RNCamera } from 'react-native-camera';
import moment from "moment";
import 'moment/locale/pt';
import AsyncStorage from '@react-native-community/async-storage';

export default class Camera extends Component {

  constructor(props) {
    super(props);
    this.state = {
      user: props.navigation.state.params.user,
      instituicao: props.navigation.state.params.instituicao,
      loading: false,
    };
  }

  static navigationOptions = {
    header: null
  };

  componentDidMount() {
    this.backHandler = BackHandler.addEventListener('hardwareBackPress', this.handleBackPress);
  }

  componentWillUnmount() {
    this.backHandler.remove();
  }

  handleBackPress = () => {
    this.props.navigation.goBack();
    return true;
  }

  compareUserPosition = (userCoords, file) => {

    const { latitude, longitude } = this.state.instituicao;

    const response = Distance.betweenPoints(
      userCoords.latitude,
      userCoords.longitude,
      latitude,
      longitude
    );

    if (response) {
      this.register(file);
    } else {
      Alert.alert(
        'Atenção',
        'Parece que você não está dentro da instituição selecionada neste momento. ' +
        'Tente novamente quando estiver em uma instituição permitida.',
        [{ text: 'OK', onPress: () => this.props.navigation.goBack() }],
        { cancelable: false },
      );
    }
  }

  register = async (file) => {

    try {
      const response = await api.post('/ponto', {
        instituicao_id: this.state.instituicao.id,
        user_id: this.state.user.id,
        foto: file
      });

      if (response.status === 200) {
        this.savePoint();
        this.identifyUserExpression(file, response.data.id);
      }
      this.setState({ loading: false });
      this.props.navigation.navigate('Main', { user: this.state.user });
    } catch (error) {
      this.setState({ loading: false });
      Alert.alert(
        'Ops!',
        `Parece que você não é o ${this.state.user.nome}. Somente o usuário correto pode bater o ponto.`,
        [{ text: 'OK', onPress: () => this.props.navigation.goBack() }],
        { cancelable: false },
      );
    }
  }

  identifyUserExpression = async (foto, id) => {
    api.post('/expressions', { id, foto });
  }

  savePoint = async () => {
    const currentDate = moment().format();
    const date = moment().format("MMMMDDYYYY");

    const ponto = { date: currentDate, instituicao: this.state.instituicao.nome };
    const response = await AsyncStorage.getItem(`@HackaPonto:points`);

    if (response) {

      let pontos = JSON.parse(response);

      if (pontos[date])
        pontos[date].push(ponto);
      else
        pontos[date] = [];

      await AsyncStorage.setItem(`@HackaPonto:points`, JSON.stringify(pontos));

    } else {
      let pontos = {};
      pontos[date] = [ponto];
      await AsyncStorage.setItem(`@HackaPonto:points`, JSON.stringify(pontos));
    }
  }

  getCurrentPosition = async (file) => {
    await navigator.geolocation.getCurrentPosition(position => {
      this.compareUserPosition(position.coords, file);
    });
  }

  takePicture = async () => {
    if (this.camera) {
      this.setState({ loading: true });
      const options = { quality: 0.6, base64: true, width: 450, height: 450 };
      const file = await this.camera.takePictureAsync(options);
      const base64 = 'data:image/jpeg;base64,' + file.base64;
      this.getCurrentPosition(base64);
    }
  }

  render() {
    return (
      <View style={styles.container}>
        <StatusBar barStyle="light-content" backgroundColor="#000" />
        <RNCamera
          ref={ref => this.camera = ref}
          style={styles.preview}
          type={RNCamera.Constants.Type.front}
          flashMode={RNCamera.Constants.FlashMode.off}
          permissionDialogTitle={'Permissão para usar a camera'}
          permissionDialogMessage={'Nós precisamos de permissão para usar a câmera'}
        />
        <View style={styles.buttonContainer}>
          <TouchableOpacity onPress={this.takePicture} style={styles.buttonRegister}>
            <Text style={styles.text}> REGISTRAR </Text>
          </TouchableOpacity>
        </View>

        {
          this.state.loading &&
          <View style={styles.loading}>
            <ActivityIndicator
              animating={true}
              color='#FFF'
              size={'large'}
            />
          </View>
        }
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#000'
  },
  text: {
    fontSize: 14,
    color: '#7159c1',
    fontWeight: 'bold'
  },
  preview: {
    flex: 1,
    justifyContent: 'flex-end',
    alignItems: 'center',
  },
  loading: {
    position: 'absolute',
    zIndex: 5,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#000',
    width: '100%',
    height: '100%',
    opacity: 0.8
  },
  buttonContainer: {
    flex: 0,
    flexDirection: 'row',
    justifyContent: 'center'
  },
  buttonRegister: {
    flex: 0,
    backgroundColor: '#FFF',
    borderRadius: 5,
    padding: 15,
    paddingHorizontal: 20,
    alignSelf: 'center',
    margin: 20
  },
});
