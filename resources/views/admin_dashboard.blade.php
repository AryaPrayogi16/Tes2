<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Attendance - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 p-4 md:p-10">

    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight">Monitoring Attendance</h1>
                <p class="text-gray-500 text-sm mt-1">Data Periode: <span class="font-semibold text-blue-600">{{ $filter['begda'] }} - {{ $filter['endda'] }}</span></p>
            </div>
            <div class="flex gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Personnel Number</p>
                    
                    <p class="text-sm font-mono text-gray-700">{{ $filter['pernr'] }}</p>
                    
                </div>
                <a href="/logout" class="bg-red-50 px-4 py-2 text-red-600 rounded-lg font-medium hover:bg-red-100 transition border border-red-200 text-sm">
                    Logout
                </a>
            </div>

        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-6">
    <form action="/admin-dashboard" method="GET" class="flex flex-wrap items-end gap-4">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Personnel No</label>
            <input type="text" name="pernr" value="{{ $filter['pernr'] }}" 
                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Start Date (DD.MM.YYYY)</label>
            <input type="text" name="begda" value="{{ $filter['begda'] }}" placeholder="01.01.2026"
                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
        </div>

        <div class="flex-1 min-w-[150px]">
            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">End Date (DD.MM.YYYY)</label>
            <input type="text" name="endda" value="{{ $filter['endda'] }}" placeholder="27.01.2026"
                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold text-sm transition-all shadow-lg shadow-blue-100 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Filter Data
        </button>
    </form>
</div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Karyawan</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Shift</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Jam Pulang</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data_attendance as $index => $row)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-6 py-4 text-center text-gray-400 text-sm">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-700">
                                    {{ \Carbon\Carbon::parse($row['BEGDA'])->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{{ $row['CNAME'] }}</div>
                                <div class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $row['ORGTX'] }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-[11px] font-medium border border-gray-200">
                                    {{ $row['TPROG'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($row['MASUK_FORMATTED'])
                                    <span class="text-sm font-mono text-blue-600 font-semibold">{{ $row['MASUK_FORMATTED'] }}</span>
                                @else
                                    <span class="text-gray-300 text-xs italic">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($row['PULNG_FORMATTED'])
                                    <span class="text-sm font-mono text-orange-600 font-semibold">{{ $row['PULNG_FORMATTED'] }}</span>
                                @else
                                    <span class="text-gray-300 text-xs italic">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($row['TPROG'] == 'FREE')
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 text-gray-500">OFF DAY</span>
                                @elseif($row['MASUK_FORMATTED'])
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-green-100 text-green-700">PRESENT</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-red-100 text-red-700">ABSENT</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 italic">
                                Tidak ada data kehadiran pada rentang tanggal ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 text-right">
            <p class="text-[10px] text-gray-400">Record Count: {{ count($data_attendance) }} | Data fetched from SAP API</p>
        </div>
    </div>

</body>
</html>