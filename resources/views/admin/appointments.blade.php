<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Appointment Management</title>
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
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%);
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
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }
        .stat-label {
            color: #64748b;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        .search-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .search-input {
            flex: 1;
        }
        .filter-select {
            width: 200px;
        }
        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
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
        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }
        .btn-warning:hover {
            background-color: #d97706;
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
            <h1><i class="fas fa-cogs"></i> Admin Appointment Management</h1>
            <div class="user-info">
                <i class="fas fa-user-shield"></i>
                <span>Administrator</span>
            </div>
        </div>
        
        <div class="content">
            <h2><i class="fas fa-chart-bar"></i> Dashboard</h2>
            
            <!-- Stats Cards -->
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number" id="totalAppointments">0</div>
                    <div class="stat-label">Total Appointments</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="pendingAppointments">0</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="acceptedAppointments">0</div>
                    <div class="stat-label">Accepted</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="declinedAppointments">0</div>
                    <div class="stat-label">Declined</div>
                </div>
            </div>
            
            <h2><i class="fas fa-list"></i> All Appointments</h2>
            
            <!-- Search and Filter -->
            <div class="search-bar">
                <div class="search-input">
                    <input type="text" id="searchInput" placeholder="Search appointments by patient or doctor...">
                </div>
                <div class="filter-select">
                    <select id="statusFilter">
                        <option value="all">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>
            </div>
            
            <div id="adminAppointmentsList">
                <!-- Admin appointments will be dynamically added here -->
            </div>
            
            <div id="noAdminAppointments" class="no-appointments">
                <i class="fas fa-calendar-times fa-3x mb-4"></i>
                <p>No appointments found.</p>
            </div>
        </div>
    </div>

    <script>
        // Sample data for demonstration
        let appointments = [
            {
                id: 1,
                doctor_name: "Dr. Smith",
                patient_name: "John Doe",
                date: "2023-11-15",
                time: "10:00",
                status: "pending"
            },
            {
                id: 2,
                doctor_name: "Dr. Johnson",
                patient_name: "Jane Smith",
                date: "2023-11-16",
                time: "14:30",
                status: "accepted"
            },
            {
                id: 3,
                doctor_name: "Dr. Williams",
                patient_name: "Robert Brown",
                date: "2023-11-17",
                time: "09:15",
                status: "declined"
            },
            {
                id: 4,
                doctor_name: "Dr. Smith",
                patient_name: "Emily Davis",
                date: "2023-11-18",
                time: "11:45",
                status: "pending"
            },
            {
                id: 5,
                doctor_name: "Dr. Brown",
                patient_name: "Michael Wilson",
                date: "2023-11-19",
                time: "15:20",
                status: "accepted"
            }
        ];

        // Render appointments for admin management
        function renderAdminAppointments() {
            const adminAppointmentsList = document.getElementById('adminAppointmentsList');
            const noAdminAppointments = document.getElementById('noAdminAppointments');
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            
            let filteredAppointments = appointments;
            
            // Apply search filter
            if (searchTerm) {
                filteredAppointments = filteredAppointments.filter(appointment => 
                    appointment.patient_name.toLowerCase().includes(searchTerm) ||
                    appointment.doctor_name.toLowerCase().includes(searchTerm)
                );
            }
            
            // Apply status filter
            if (statusFilter !== 'all') {
                filteredAppointments = filteredAppointments.filter(appointment => 
                    appointment.status === statusFilter
                );
            }
            
            if (filteredAppointments.length === 0) {
                adminAppointmentsList.innerHTML = '';
                noAdminAppointments.style.display = 'block';
                return;
            }
            
            noAdminAppointments.style.display = 'none';
            adminAppointmentsList.innerHTML = '';
            
            filteredAppointments.forEach(appointment => {
                const appointmentCard = document.createElement('div');
                appointmentCard.className = 'appointment-card';
                
                let statusClass = 'status-pending';
                if (appointment.status === 'accepted') statusClass = 'status-accepted';
                if (appointment.status === 'declined') statusClass = 'status-declined';
                
                appointmentCard.innerHTML = `
                    <p><strong>ID:</strong> ${appointment.id}</p>
                    <p><strong>Doctor:</strong> ${appointment.doctor_name}</p>
                    <p><strong>Patient:</strong> ${appointment.patient_name}</p>
                    <p><strong>Date:</strong> ${appointment.date}</p>
                    <p><strong>Time:</strong> ${appointment.time}</p>
                    <p><strong>Status:</strong> <span class="${statusClass}">${appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1)}</span></p>
                    
                    <div class="action-buttons">
                        <button class="btn btn-warning" onclick="editAppointment(${appointment.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger" onclick="deleteAppointment(${appointment.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                `;
                
                adminAppointmentsList.appendChild(appointmentCard);
            });
        }
        
        // Edit appointment (simulated)
        function editAppointment(id) {
            alert(`Edit functionality for appointment #${id} would open here in a real application.`);
        }
        
        // Delete appointment
        function deleteAppointment(id) {
            if (confirm('Are you sure you want to delete this appointment?')) {
                appointments = appointments.filter(appointment => appointment.id !== id);
                renderAdminAppointments();
                updateStats();
            }
        }
        
        // Update stats
        function updateStats() {
            document.getElementById('totalAppointments').textContent = appointments.length;
            document.getElementById('pendingAppointments').textContent = 
                appointments.filter(a => a.status === 'pending').length;
            document.getElementById('acceptedAppointments').textContent = 
                appointments.filter(a => a.status === 'accepted').length;
            document.getElementById('declinedAppointments').textContent = 
                appointments.filter(a => a.status === 'declined').length;
        }
        
        // Search and filter functionality
        document.getElementById('searchInput').addEventListener('input', renderAdminAppointments);
        document.getElementById('statusFilter').addEventListener('change', renderAdminAppointments);
        
        // Initial render
        renderAdminAppointments();
        updateStats();
    </script>
</body>
</html>