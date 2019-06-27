function deg2rad(deg) {
  return deg * (Math.PI / 180);
};

function contaDoida(latDistance, lonDistance, lat1, lat2) {
  return Math.sin(latDistance / 2) * Math.sin(latDistance / 2)
        + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2))
        * Math.sin(lonDistance / 2) * Math.sin(lonDistance / 2);
};

function contaDoida2(a) {
  return 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
};

function resultadoContaTotal(c) {

  const raioDaTerra = 6371;
  return raioDaTerra * c * 1000;
};

const Distance = {

  betweenPoints(lat1, long1, lat2, long2, distanciaMaxima = 50) {

    const latDistance = deg2rad(lat2 - lat1);
    const lonDistance = deg2rad(long2 - long1);
    const a = contaDoida(latDistance, lonDistance, lat1, lat2);
    const c = contaDoida2(a);
    const distance = resultadoContaTotal(c);

    if (distance > distanciaMaxima)
      return false;

    return true;
  },
};

export default Distance;




