<div>
    <div class="border-b border-gray-200 dark:border-neutral-700">
      <nav class="-mb-0.5 flex justify-center gap-x-6" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
        <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500 active" id="horizontal-alignment-item-1" aria-selected="true" data-hs-tab="#horizontal-alignment-1" aria-controls="horizontal-alignment-1" role="tab">
          Hardware Tutorial
        </button>
        <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="horizontal-alignment-item-2" aria-selected="false" data-hs-tab="#horizontal-alignment-2" aria-controls="horizontal-alignment-2" role="tab">
          Web Interface Tutorial
        </button>
      </nav>
    </div>
      
    <div class="mt-3">
        <div id="horizontal-alignment-1" role="tabpanel" aria-labelledby="horizontal-alignment-item-1">
          <div class="hs-accordion-group">
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-one">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                Sensors, Main Controller and Actuators Identification & Function Guide
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                
                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/12V Air Circulation DC Fan.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">12V Air Circulation DC Fan</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Provides airflow and ventilation to reduce humidity
                          and heat buildup around plants.</li>
                        <li class="list-disc">Troubleshooting Tip: Clean the fan blades and check the
                          power connection if the fan stops or weakens.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/100W Full Spectrum Sunshine.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">100W Full Spectrum Sunshine</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Mimics natural sunlight to promote
                          photosynthesis and healthy plant growth.</li>
                        <li class="list-disc">Troubleshooting Tip: Ensure proper placement to avoid
                          overheating nearby components.                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Capacitive Soil Moisture Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Capacitive Soil Moisture Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Detects soil moisture levels without corrosion-prone
                          metal parts, giving more accurate and long-lasting readings.</li>
                        <li class="list-disc">Troubleshooting Tip: Ensure proper insertion into the soil and
                          keep the sensor clean and dry at the connector area.                                                    
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/DHT11 Temp and Humidity Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">DHT11 - Temperature & Humidity Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Tracks the temperature and relative humidity of
                          the environment to ensure optimal plant conditions.</li>
                        <li class="list-disc">Troubleshooting Tip: Keep away from direct misting or
                          moisture to avoid inaccurate readings.                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/HCSR04 Ultrasonic Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">HCSR04 Ultrasonic Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Measures water level by emitting ultrasonic
                          waves and calculating distance based on the time it
                          takes for the echo to return.</li>
                        <li class="list-disc">Troubleshooting Tip: Make sure the sensor has a clear
                          path and is free from dust, condensation, or water
                          splashes.                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Liquid pH Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">pH-4502C Liquid pH Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Monitors the pH level of water or nutrient solutions in
                          real time for proper plant nutrient absorption.</li>
                        <li class="list-disc">Troubleshooting Tip: Calibrate using buffer solutions and
                          clean the sensor tip gently to maintain accuracy.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/RS485 Soil pH Sensor.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">RS485 Soil pH Sensor</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Measures soil acidity or alkalinity using RS485
                          communication for reliable and long-distance data
                          transmission.
                        </li>
                        <li class="list-disc">Troubleshooting Tip: Calibrate regularly and clean the
                          sensor probe to avoid buildup that may affect accuracy.                         
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/1 Channel 5V Relay.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">1 Channel 5V Relay</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Acts as a switch to control high-power
                          devices like pumps or lights using
                          microcontroller signals.                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Buck-Converter.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Buck Converter</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Steps down a higher voltage to a lower
                          voltage efficiently, useful for matching the voltage
                          requirement of components.                                                   
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/DS1302 RTC Module with Battery.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">DS1302 RTC Module with Battery</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Keeps real-time clock data even during power interruptions, ensuring time-sensitive tasks stay accurate.                                              
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/ESP8266 Wemos D1 Mini Pro.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">ESP8266 Wemos D1 Mini Pro</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: A smaller version of the NodeMCU that
                          also transmits data wirelessly and fits well in
                          compact setups.                                                   
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/NODE MCU ESP8266 WIFI MODULE V3.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">NodeMCU ESP8266 Wi-Fi Module Version 3</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Acts as the main controller that
                          processes sensor data and sends it to a web or
                          cloud system via Wi-Fi.                                                   
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/NodeMCU ESP8266 Wi-Fi Module Version 3 Baseboard.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">NodeMCU ESP8266 Wi-Fi Module Version 3 Baseboard</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Provides stable power and easy wiring
                          connections for the NodeMCU to connect with
                          sensors and modules.</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/RS485 Module.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">RS485 Module</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Converts serial communication to
                          RS485 standard for long-distance and noiseresistant data transmission.</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/SIM 800L GSM Module Version 2.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">SIM800L GSM Module Version 2</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Sends SMS notifications or allows
                          GSM-based communication for systems
                          without Wi-Fi access.</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Switch Mode Power Supply 12V 10Amp.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Switch Mode Power Supply 12V 10Amp</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Provides stable 12V power output for
                          high-powered components like fans, pumps, or
                          lights.</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/Switch Mode Power Supply 5V 10Amp.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">Switch Mode Power Supply 5V 10Amp</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Supplies a steady 5V power
                          source to microcontrollers and sensors.</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/USB 5V Water Pump.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">USB 5V Water Pump</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Circulates water for irrigation or
                          nutrient delivery in a plant system.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex gap-5">
                    <div class="max-w-40 max-h-40">
                      <img src="{{ asset('images/USB Cable Micro.png') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-col justify-center">
                      <h2 class="font-semibold">USB Cable Micro</h2>
                      <ul class="ml-8">
                        <li class="list-disc">Function: Powers microcontrollers and allows
                          data transfer from microcontrollers to
                          computers.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                {{-- END --}}
              </div>
            </div>
          
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-two">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                How to Place the Sensor (Sensor Placement Guide)
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                <div class="w-full max-w-3xl mx-auto aspect-video">
                  <video class="w-full h-full" controls>
                    <source src="{{ asset('/images/sensor-placements.mp4') }}" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
          
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-three">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                How to start the iBroccoGreens Device (Video Demo)
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                <div class="w-full max-w-3xl mx-auto aspect-video">
                  <video class="w-full h-full" controls>
                    <source src="{{ asset('/images/broccoli-device.mp4') }}" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>

            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-four">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
                Floorplan of iBroccoGreens Device
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-four" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
                <div class="w-full max-w-full grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="flex flex-col items-center">
                    <img src="{{ asset('/images/guide/SE.png') }}" alt="SE View" class="w-full h-auto object-cover rounded">
                    <h4 class="mt-2 text-center font-medium">SE View</h4>
                  </div>
                  <div class="flex flex-col items-center">
                    <img src="{{ asset('/images/guide/SW.png') }}" alt="SW View" class="w-full h-auto object-cover rounded">
                    <h4 class="mt-2 text-center font-medium">SW View</h4>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div id="horizontal-alignment-2" class="hidden" role="tabpanel" aria-labelledby="horizontal-alignment-item-2">
          <div class="hs-accordion-group">

            {{-- SENSOR ALERT NOTIFICATION --}}
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-one">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
                Sensor Alert Notification
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-[400px] max-h-[400px]">
                      <img src="{{ asset('/images/soil-moist-notif.jpg') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">High Soil Moisture</li>
                          <li class="text-center">Low Soil Moisture</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">Risk of overwatering</li>
                          <li class="text-center">Soil is too dry</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-[400px] max-h-[400px]">
                      <img src="{{ asset('/images/temp-notif.jpg') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">High Temperature</li>
                          <li class="text-center">Low Temperature</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">Risk of heat stress</li>
                          <li class="text-center">Too cold for proper growth</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-[400px] max-h-[400px]">
                      <img src="{{ asset('/images/humid-notif.jpg') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">High Humidity</li>
                          <li class="text-center">Low Humidity</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">May cause mold or disease</li>
                          <li class="text-center">Can dry out plants</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="w-full h-auto flex flex-col mb-5">
                  <div class="w-full h-auto flex flex-col md:flex-row justify-center items-center gap-5">
                    <div class="max-w-[400px] max-h-[400px]">
                      <img src="{{ asset('/images/water-ph-notif.jpg') }}" alt="" class="w-full h-auto">
                    </div>
                    <div class="flex flex-row justify-around w-full">
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Alert</h2>
                        <ul>
                          <li class="text-center">Water pH - Too Low</li>
                          <li class="text-center">Water pH - Too High</li>
                        </ul>
                      </div>
                      <div class="flex flex-col justify-center items-center">
                        <h2 class="font-semibold">Meaning</h2>
                        <ul>
                          <li class="text-center">Nutrient imbalance risk.</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {{-- HOW TO USE THE IBROCCOGREENS WEBISTE --}}
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-two">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
                How to Use the iBroccoGreens Website
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
                <div class="w-full h-auto flex flex-col gap-8">
                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Login.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Login.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">LOG IN</h2>
                    <p class="text-center">The login page allows users to enter their registered credentials if they have already
                      created an account, enabling them to access and use the iBroccogreens Web
                      system.
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Signup.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Signup.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">SIGN IN</h2>
                    <p class="text-center">The signup page is where Admin and Users enter their full name, email address, and
                      password. These credentials will be used to log in to the iBroccoGreens Web System                      
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Terms-and-Conditions.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Terms-and-Conditions.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">TERMS AND CONDITION PAGE</h2>
                    <p class="text-center">The Terms and Conditions outline the rules and responsibilities that users agree to when
                      accessing and using the iBroccoGreens system.                                            
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Growers-Guide.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Growers-Guide.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">GROWERS GUIDE PAGE</h2>
                    <p class="text-center">The Grower's Guide contains essential information on system usage. Users can access:
                      (1) Hardware Tutorial - for understanding the sensors and components
                      (2) Web Interface Tutorial - for navigating the system's online features                                          
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Parameters.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Parameters.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">PARAMETERS</h2>
                    <p class="text-center">The real-time Parameters Monitoring page allows Admin and Users to track sensor
                      readings, including Soil pH, Water pH, Soil Moisture, Temperature, and Humidity.                                         
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Daily-Records-New-M.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Daily-Records-New-D.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">DAILY RECORDS PAGE</h2>
                    <p class="text-center">The Daily Records section allows the Admin to view sensor trends through graphical
                      charts and timestamped logs of data, including soil pH, water pH, temperature, humidity,
                      and moisture levels.                                         
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Cultivation-Cycle.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Cultivation-Cycle.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">CULTIVATION CYCLES PAGE</h2>
                    <p class="text-center">The Cultivation Cycle page allows Admins and Users to manage cycle information.
                      Fields include Cycle Number, Start Date, End Date, Assigned Trays, Duration in Days, and
                      Current Phase (e.g., Germination, Growth, Harvest).
                      It also provides options to Edit or Remove a cycle.                                      
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/Yield-Tracker-Page.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/Yield-Tracker-Page.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">YIELD TRACKER PAGE</h2>
                    <p class="text-center">The Yield Tracker page allows users to document production results.
                      Fields include Cycle, Tray, Yield per Tray, and Date, with options to edit and remove
                      entries.                                                           
                    </p>
                    <p class="text-center mt-2">The system also visualizes yields in a graph for performance tracking.</p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/User-Registration.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/User-Registration.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">USER REGISTRATION</h2>
                    <p class="text-center">The Admin interface lets administrators register new users by entering their full name,
                      email address, password, and status (Active or Inactive).                                             
                    </p>
                  </div>

                  <div>
                    <div class="w-full flex flex-col md:flex-row items-center justify-center gap-6">
                      <!-- Mobile image -->
                      <div class="aspect-[9/19.5] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl shadow-md">
                        <img src="{{ asset('/images/guide/User-Management.jpg') }}" alt="Mobile View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                    
                      <!-- Desktop image -->
                      <div class="aspect-[16/10] h-80 md:h-96 flex items-center justify-center bg-gray-100 rounded-xl">
                        <img src="{{ asset('/images/guide/desktop/User-Management.jpg') }}" alt="Desktop View"
                             class="w-full h-full object-contain rounded-xl shadow-md" />
                      </div>
                      
                    </div>
                    <h2 class="text-center mt-5 font-semibold">USER MANAGEMENT</h2>
                    <p class="text-center">This figure shows where the Admin can view a list of registered users and perform actions
                      such as removing them from the system.                                             
                    </p>
                  </div>

                </div>
              </div>
            </div>

            {{-- HOW TO USE THE IBROCCOGREENS WEBISTE VIDEO --}}
            <div class="hs-accordion" id="hs-basic-with-title-and-arrow-stretched-heading-three">
              <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-gray-800 hover:text-gray-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-hidden dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
                How to Use the iBroccoGreens Website (Video Demo)
                <svg class="hs-accordion-active:hidden block size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m6 9 6 6 6-6"></path>
                </svg>
                <svg class="hs-accordion-active:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m18 15-6-6-6 6"></path>
                </svg>
              </button>
              <div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
                <div class="w-full max-w-full mx-auto aspect-video">
                  <video class="w-full h-full" controls>
                    <source src="{{ asset('/images/WEB-VIDEO-TUTORIAL.mp4') }}" type="video/mp4" />
                    Your browser does not support the video tag.
                  </video>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
