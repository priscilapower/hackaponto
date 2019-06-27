import React, { Component } from 'react';
import {
  TouchableOpacity,
  StyleSheet
} from 'react-native';
import { withNavigation } from 'react-navigation';
import Icon from 'react-native-vector-icons/MaterialIcons';

class ReportButton extends Component {

  openReport = () => {
    this.props.navigation.navigate('Relatorio');
  }

  render() {
    return (
      <TouchableOpacity style={styles.button} onPress={this.openReport}>
        <Icon name="schedule" size={27} color="#7159c1" />
      </TouchableOpacity>
    );
  }
}

const styles = StyleSheet.create({
  button: {
    position: 'absolute',
    bottom: '17%',
    borderRadius: 25,
    backgroundColor: '#FFF',
    width: 40,
    height: 40,
    alignItems: 'center',
    justifyContent: 'center'
  }
});

export default withNavigation(ReportButton);
