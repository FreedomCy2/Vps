<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }
        .content {
            padding: 2rem;
        }
        h2 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .appointment-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .appointment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .status-pending {
            color: #f59e0b;
            font-weight: 600;
            background: #fef3c7;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.875rem;
            display: inline-block;
        }
        .status-accepted {
            color: #10b981;
            font-weight: 600;
            background: #d1fae5;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.875rem;
            display: inline-block;
        }
        .status-declined {
            color: #ef4444;
            font-weight: 600;
            background: #fee2e2;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.875rem;
            display: inline-block;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-success {
            background-color: #10b981;
            color: white;
        }
        .btn-success:hover {
            background-color: #059669;
        }
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background-color: #dc2626;
        }
        .no-appointments {
            text-align: center;
            padding: 3rem;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-md"></i> Manage Appointments</h1>
            <div class="user-info">
                <i class="fas fa-user-md"></i>
                <span>Dr. Smith</span>
            </div>
        </div>
        
        <div class="content">
            <h2><i class="fas fa-list"></i> Appointment Requests</h2>
            
            <div id="appointmentsList">
                <!-- Appointments will be dynamically added here -->
            </div>
            
            <div id="noAppointments" class="no-appointments">
                <i class="fas fa-calendar-times fa-3x mb-4"></i>
                <p>No appointments to manage.</p>
            </div>
        </div>
    </div>

    <script>
        // Sample data for demonstration
        let appointments = [
            {
                id: 1,
                patient_name: "John Doe",
                date: "2023-11-15",
                time: "10:00",
                status: "pending"
            },
            {
                id: 2,
                patient_name: "Jane Smith",
                date: "2023-11-16",
                time: "14:30",
                status: "accepted"
            },
            {
                id: 3,
                patient_name: "Robert Brown",
                date: "2023-11-17",
                time: "09:15",
                status: "pending"
            },
            {
                id: 4,
                patient_name: "Emily Davis",
                date: "2023-11-18",
                time: "11:45",
                status: "declined"
            }
        ];

        // Render appointments
        function renderAppointments() {
            const appointmentsList = document.getElementById('appointmentsList');
            const noAppointments = document.getElementById('noAppointments');

            if (appointments.length === 0) {
                appointmentsList.innerHTML = '';
                noAppointments.style.display = 'block';
                return;
            }

            noAppointments.style.display = 'none';
            appointmentsList.innerHTML = '';

            appointments.forEach(appointment => {
                const appointmentCard = document.createElement('div');
                appointmentCard.className = 'appointment-card';
                
                let statusClass = 'status-pending';
                if (appointment.status === 'accepted') statusClass = 'status-accepted';
                if (appointment.status === 'declined') statusClass = 'status-declined';

                appointmentCard.innerHTML = `
                    <p><strong>Patient:</strong> ${appointment.patient_name}</p>
                    <p><strong>Date:</strong> ${appointment.date}</p>
                    <p><strong>Time:</strong> ${appointment.time}</p>
                    <p><strong>Status:</strong> <span class="${statusClass}">${appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)}</span></p>
                    
                    ${appointment.status === 'pending' ? `
                    <div class="action-buttons">
                        <button class="btn btn-success" onclick="updateAppointmentStatus(${appointment.id}, 'accepted')">
                            <i class="fas fa-check"></i> Accept
                        </button>
                        <button class="btn btn-danger" onclick="updateAppointmentStatus(${appointment.id}, 'declined')">
                            <i class="fas fa-times"></i> Decline
                        </button>
                    </div>
                    ` : ''}
                `;

                appointmentsList.appendChild(appointmentCard);
            });
        }

        // Update appointment status
        function updateAppointmentStatus(id, status) {
            appointments = appointments.map(appointment => {
                if (appointment.id === id) {
                    return { ...appointment, status };
                }
                return appointment;
            });

            renderAppointments();
        }

        // Initial render
        renderAppointments();
    </script>
</body>
</html>