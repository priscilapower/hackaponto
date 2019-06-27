import React, { Component } from 'react';

import {
  View,
  ScrollView,
  TouchableOpacity,
  Text,
  StyleSheet,
  ActivityIndicator
} from 'react-native';
import api from '../../services/api';

export default class Instituicao extends Component {

  constructor(props) {
    super(props);
    this.state = {
      loading: false,
      instituicoes: []
    }
  }

  static navigationOptions = ({ navigation }) => ({
    title: 'Instituições',
    headerStyle: {
      backgroundColor: '#7159C1',
    },
    headerTintColor: '#FFF'
  });

  componentDidMount() {
    this.loadInstituicoes();
  }

  loadInstituicoes = async () => {
    try {
      this.setState({ loading: true });
      const response = await api.get('/instituicao');
      this.setState({ instituicoes: response.data });
    } catch (error) {
      console.warn(error);
    } finally {
      this.setState({ loading: false });
    }
  }

  selectInstituicao = (instituicao) => {
    this.props.navigation.state.params.setInstituicao(instituicao);
    this.props.navigation.goBack();
  }

  render() {
    return (
      <View style={styles.container}>
        <ScrollView
          contentContainerStyle={styles.listContainer}
          showsVerticalScrollIndicator={false}
          style={styles.list}>

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

          {
            this.state.instituicoes.map(instituicao => (
              <TouchableOpacity key={instituicao.id} onPress={() => this.selectInstituicao(instituicao)} style={styles.containerInstituicao}>
                <Text style={{ color: '#FFF', fontSize: 18 }}>{instituicao.nome}</Text>
              </TouchableOpacity>
            ))
          }

        </ScrollView>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#7159c1',
    paddingTop: 10
  },
  listContainer: {
    paddingBottom: 10,
    justifyContent: 'center',
    alignItems: 'center'
  },
  list: {
    flex: 1,
    paddingBottom: 10,
    width: '100%'
  },
  loading: {
    marginTop: 10
  },
  containerInstituicao: {
    width: '95%',
    height: 50,
    flexDirection: 'row',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#FFF',
    paddingHorizontal: 16,
    marginVertical: 5,
    alignItems: 'center',
    justifyContent: 'center',
  }
});
