<template>
		<div id="map">
			<GmapMap ref="mapRef"
				:center="{
					lat: location.latitude, 
					lng: location.longitude,
				}"
				:zoom="18"
				:options="mapOptions"
				:style="{ height: height, width: width }"
			>
				<GmapMarker :ref="'myMarker'" :width="'20px'"
				    :position="google && new google.maps.LatLng(location.latitude, location.longitude)"
				    :icon="{ url: '../images/PBEDPin.png'}" 
				></GmapMarker>
			</GmapMap>
		</div>
</template>

<script>

	import {gmapApi} from 'vue2-google-maps'

	export default {
		data() {
			return {
				location: {
					latitude : parseFloat(this.pbedLatitude),
					longitude : parseFloat(this.pbedLongitude)
				},

				/** Maps */
				mapOptions: {
					zoomControl: false,
					mapTypeControl: false,
					scaleControl: true,
					streetViewControl: false,
					rotateControl: false,
					fullscreenControl: false,
					disableDefaultUi: false,
					styles:
					[
					  {
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#f5f5f5"
					      }
					    ]
					  },
					  {
					    "elementType": "labels.icon",
					    "stylers": [
					      {
					        "visibility": "off"
					      }
					    ]
					  },
					  {
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "administrative.land_parcel",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "poi",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#eeeeee"
					      }
					    ]
					  },
					  {
					    "featureType": "poi",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "poi.park",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#eeeeee"
					      }
					    ]
					  },
					  {
					    "featureType": "poi.park",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "road",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#ffffff"
					      }
					    ]
					  },
					  {
					    "featureType": "road.arterial",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "road.highway",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#ffffff"
					      }
					    ]
					  },
					  {
					    "featureType": "road.highway",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "road.local",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  },
					  {
					    "featureType": "transit.line",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#e5e5e5"
					      }
					    ]
					  },
					  {
					    "featureType": "transit.station",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#eeeeee"
					      }
					    ]
					  },
					  {
					    "featureType": "water",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#eeeeee"
					      }
					    ]
					  },
					  {
					    "featureType": "water",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#c7c7c7"
					      }
					    ]
					  }
					]
				}
			};
		},

		props: {
			height: {
				default: '100%',
				type: String
			},
			width: {
				default: '100%',
				type: String
			},

			pbedLatitude: String,
			pbedLongitude: String,
		},

		computed: {
			google: gmapApi,
		},

		mounted() {
			// this.$refs.mapRef.$mapPromise.then((map) => {
		 //      	map.panTo({lat: 1.38, lng: 103.80})
		 //    })
		}
	}
</script>