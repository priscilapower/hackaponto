import React, { Component } from 'react';

import {
  Text,
  StyleSheet,
  TouchableOpacity,
  ImageBackground,
  View,
  BackHandler
} from 'react-native';

import ReportButton from '../../components/ReportButton';
import Toast from 'react-native-simple-toast';
import AsyncStorage from '@react-native-community/async-storage';
import Icon from 'react-native-vector-icons/MaterialIcons';

export default class Main extends Component {

  constructor(props) {
    super(props);
    this.state = {
      user: props.navigation.state.params.user,
      instituicaoSelected: null
    }
  }

  static navigationOptions = {
    header: null
  };

  componentDidMount() {
    BackHandler.addEventListener('hardwareBackPress', this.handleBackPress);
  }

  componentWillUnmount() {
    BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress);
  }

  handleBackPress = () => {
    BackHandler.exitApp();
    return true;
  }

  signOut = async () => {
    try {
      await AsyncStorage.removeItem('@HackaPonto:user');
      await AsyncStorage.removeItem("@HackaPonto:password");
      await AsyncStorage.removeItem("@HackaPonto:points");
    } catch (error) {
      console.warn(error);
    }
    this.props.navigation.navigate('Login');
  }

  register = () => {
    if (this.state.instituicaoSelected) {
      this.props.navigation.navigate('Camera',
        { user: this.state.user, instituicao: this.state.instituicaoSelected }
      );
    } else {
      Toast.showWithGravity('Selecione uma instituição', Toast.SHORT, Toast.TOP);
    }
  }

  setInstituicao = (instituicaoSelected) => {
    this.setState({ instituicaoSelected });
  }

  selectInstituicao = () => {
    this.props.navigation.navigate('Instituicao', { setInstituicao: this.setInstituicao });
  }

  render() {
    return (
      <ImageBackground
        source={{ uri: 'https://s3-sa-east-1.amazonaws.com/rocketseat-cdn/background.png' }}
        style={styles.container}
        resizeMode="cover"
      >

        <ReportButton />

        <TouchableOpacity onPress={this.selectInstituicao} style={styles.instituicaoContainer}>
          <Text style={styles.textInstituicao}>
            {this.state.instituicaoSelected ? this.state.instituicaoSelected.nome : 'Selecione uma instituição...'}
          </Text>
        </TouchableOpacity>

        <View style={styles.register}>
          <TouchableOpacity style={styles.button} onPress={this.register}>
            <Icon name="check-circle" size={35} color="#6bd4c1" />
            <Text style={styles.textButton}>REGISTRAR</Text>
          </TouchableOpacity>
        </View>

        <View style={styles.exitContainer}>
          <TouchableOpacity style={styles.exitButton} onPress={this.signOut}>
            <Icon name="exit-to-app" size={25} color="#FFF" />
            <Text style={styles.textInstituicao}>SAIR</Text>
          </TouchableOpacity>
        </View>

      </ImageBackground>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    alignItems: 'center',
    flex: 1,
  },
  textInstituicao: {
    color: '#FFF',
    fontWeight: 'bold',
    fontSize: 18,
    marginLeft: 10
  },
  register: {
    flex: 1,
    position: 'absolute',
    top: '40%',
    alignItems: 'center',
    width: '100%'
  },
  instituicaoContainer: {
    width: '80%',
    borderWidth: 1,
    borderColor: '#FFF',
    height: 50,
    marginTop: 100,
    borderRadius: 5,
    paddingHorizontal: 16,
    marginVertical: 10,
    alignItems: 'center',
    justifyContent: 'center',
  },
  button: {
    width: '80%',
    height: 200,
    flexDirection: 'row',
    backgroundColor: '#fff',
    borderRadius: 10,
    paddingHorizontal: 16,
    alignItems: 'center',
    justifyContent: 'center',
  },
  exitContainer: {
    flex: 1,
    position: 'absolute',
    bottom: '1%',
    zIndex: 5,
    alignItems: 'center',
    width: '100%'
  },
  exitButton: {
    width: '80%',
    height: 50,
    flexDirection: 'row',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#FFF',
    paddingHorizontal: 16,
    marginVertical: 10,
    alignItems: 'center',
    justifyContent: 'center',
  },
  textButton: {
    color: '#7159c1',
    fontWeight: 'bold',
    fontSize: 24,
    marginLeft: 10
  }
});

