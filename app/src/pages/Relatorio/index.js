import React, { Component } from 'react';

import {
  View,
  ScrollView,
  TouchableOpacity,
  Text,
  StyleSheet,
  ActivityIndicator
} from 'react-native';
import AsyncStorage from '@react-native-community/async-storage';
import moment from "moment";

export default class Relatorio extends Component {

  constructor(props) {
    super(props);
    this.state = {
      loading: false,
      pontos: [],
    }
  }

  static navigationOptions = ({ navigation }) => ({
    title: 'Relatório diário',
    headerStyle: {
      backgroundColor: '#7159C1',
    },
    headerTintColor: '#FFF'
  });

  componentDidMount() {
    this.loadPoints();
  }

  loadPoints = async () => {
    this.setState({ loading: true });

    const date = moment().format("MMMMDDYYYY");

    const response = await AsyncStorage.getItem(`@HackaPonto:points`);

    if (response) {
      const pontos = JSON.parse(response);

      if (pontos[date])
        this.setState({ pontos: pontos[date] });

      this.setState({ loading: false });

    } else {
      this.setState({ loading: false });
    }

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

          <Text style={styles.day}>{moment().format("LL")}</Text>

          {
            !this.state.pontos.length &&
            <Text style={[styles.day, { marginTop: '60%' }]}>
              Você ainda não bateu seu ponto hoje
            </Text>
          }

          {
            this.state.pontos.map(ponto => (
              <View key={ponto.date} style={styles.containerPoints}>
                <Text style={{ color: '#FFF', fontSize: 18 }}>{moment(ponto.date).format("hh:mm")} - </Text>
                <Text style={{ color: '#FFF', fontSize: 18 }}>{ponto.instituicao}</Text>
              </View>
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
  day: {
    color: '#FFF',
    fontSize: 18,
    fontWeight: 'bold',
    marginVertical: 10,
  },
  list: {
    flex: 1,
    paddingBottom: 10,
    width: '100%'
  },
  loading: {
    marginTop: 10
  },
  containerPoints: {
    width: '80%',
    height: 50,
    flexDirection: 'row',
    borderRadius: 5,
    borderBottomWidth: 1,
    borderColor: '#FFF',
    paddingHorizontal: 16,
    marginVertical: 5,
    alignItems: 'center',
    justifyContent: 'center',
  }
});
