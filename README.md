# MelonTrack IoT - Smart IoT Solution for Melon Farming

**MelonTrack IoT** is a **web-based IoT platform** for real-time monitoring and automation of **melon farming operations**. Built with **Laravel (TALL Stack)**, **Firebase**, and **SIM800L GSM**, it tracks critical environmental and soil parameters such as **soil moisture, soil pH, water pH, temperature (°C), and humidity (%)**.

The system automates **irrigation, ventilation, and lighting**, while also sending **SMS alerts** whenever sensor thresholds are exceeded—helping farmers respond immediately even without internet connectivity.

Deployed on **Hostinger**.  
Live app: [MelonTrack IoT](https://melontrackiot.tech/)

---

# Features

## 🌱 Real-time Monitoring
- **Soil Moisture (%)**: Monitors soil water levels for healthy melon growth.
- **Soil pH**: Tracks soil acidity and alkalinity balance.
- **Water pH**: Ensures nutrient water quality remains optimal.
- **Temperature (°C)**: Maintains ideal growing temperature conditions.
- **Humidity (%)**: Monitors greenhouse or farm humidity levels.
- Real-time charts and historical logs powered by **Firebase**.

## ⚡ Automated Control
- Automatic control of:
  - **Irrigation systems**
  - **Ventilation fans**
  - **Grow lights**
- Sensor thresholds configurable through the web dashboard.

## 📩 SMS Threshold Alerts (SIM800L)
- **SIM800L GSM module** sends SMS alerts whenever readings go beyond safe thresholds.

### Example alerts:
- **Soil Moisture < 40%**
  → “⚠ Low soil moisture detected in melon field.”

- **Water pH > 7.5**
  → “⚠ Water pH too high, nutrient adjustment required.”

- **Temperature > 30°C**
  → “⚠ High temperature detected in greenhouse.”

Works even without internet connectivity.

## 📊 Farm Cycle & Harvest Tracking
- Create and monitor **planting cycles**.
- Record **melon harvest yield (kg/tons)** for analytics and productivity tracking.

## 🎛 Manual Device Control
- Web dashboard for manually controlling:
  - Pumps
  - Fans
  - Lights

---

# Hardware Setup

1. **ESP32** – central IoT controller.
2. **SIM800L GSM Module** – SMS alert communication.
3. **Sensors**:
   - **Soil Moisture Sensor**
   - **Soil pH Sensor**
   - **Water pH Sensor**
   - **DHT22 Sensor** – temperature & humidity monitoring.

4. **Actuators**:
   - **Water pump** – smart irrigation.
   - **Ventilation fan** – airflow management.
   - **Grow lights** – automated lighting schedules.

---

# Installation

## Prerequisites
- **PHP** >= 8.1
- **Composer**
- **Node.js & NPM**
- **Laravel**
- **Firebase Project**
- **ESP8266 + SIM800L + Sensors**

## Setup Steps

1. Clone the repository:

```bash
git clone https://github.com/yourusername/MelonTrack-IoT.git
cd MelonTrack-IoT
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install && npm run build
```

4. Copy environment file:

```bash
cp .env.example .env
```

5. Generate Laravel application key:

```bash
php artisan key:generate
```

6. Configure your database and Firebase credentials inside `.env`.

7. Run migrations:

```bash
php artisan migrate
```

8. Start the Laravel development server:

```bash
php artisan serve
```

---

# Tech Stack

- **Laravel (TALL Stack)**
- **Livewire**
- **Tailwind CSS**
- **Alpine.js**
- **Firebase Realtime Database**
- **ESP8266**
- **SIM800L GSM Module**
- **Hostinger Deployment**

---

# Future Improvements

- 📱 Mobile application support
- ☁ Cloud analytics dashboard
- 🤖 AI-based crop prediction and recommendations
- 🔔 Push notifications integration
- 🌍 Multi-farm management

---

# License

This project is licensed under the MIT License.