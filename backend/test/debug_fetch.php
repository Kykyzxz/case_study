<?php
// debug_fetch.php - Comprehensive debugging script
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug Fetch Script</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #0f172a; color: #93c5fd; }
        h1, h2, h3 { color: #fbbf24; }
        .success { color: #10b981; background: rgba(16, 185, 129, 0.1); padding: 15px; border-radius: 8px; margin: 10px 0; }
        .error { color: #ef4444; background: rgba(239, 68, 68, 0.1); padding: 15px; border-radius: 8px; margin: 10px 0; }
        .warning { color: #f59e0b; background: rgba(245, 158, 11, 0.1); padding: 15px; border-radius: 8px; margin: 10px 0; }
        .info { color: #93c5fd; background: rgba(147, 197, 253, 0.1); padding: 15px; border-radius: 8px; margin: 10px 0; }
        pre { background: #1e293b; padding: 15px; border-radius: 8px; overflow-x: auto; }
        code { background: #1e293b; padding: 2px 8px; border-radius: 4px; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th, td { border: 1px solid #93c5fd; padding: 10px; text-align: left; }
        th { background: #1e3a8a; color: #fbbf24; }
        .test-section { border: 2px solid #93c5fd; border-radius: 10px; padding: 20px; margin: 20px 0; }
    </style>
</head>
<body>

<h1>🔍 Complete Fetch Debug Report</h1>

<?php
// ============================================
// TEST 1: Check Connection File Paths
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 1: Connection File Discovery</h2>";

$connection_paths = [
    "backend/connection/connect.php",
    "../backend/connection/connect.php",
    "../../backend/connection/connect.php",
    "ADMIN/backend/connection/connect.php",
    "../ADMIN/backend/connection/connect.php"
];

$connection_file = null;
foreach ($connection_paths as $path) {
    $full_path = __DIR__ . '/' . $path;
    echo "<p>Checking: <code>$path</code> → ";
    if (file_exists($path)) {
        echo "<span class='success'>✓ FOUND</span></p>";
        $connection_file = $path;
        break;
    } else {
        echo "<span class='error'>✗ Not found (tried: $full_path)</span></p>";
    }
}

if ($connection_file) {
    echo "<div class='success'>✓ Will use: <code>$connection_file</code></div>";
} else {
    echo "<div class='error'>✗ No connection file found! Please check your file structure.</div>";
    echo "<div class='warning'>Current directory: <code>" . __DIR__ . "</code></div>";
    echo "</div></body></html>";
    exit;
}
echo "</div>";

// ============================================
// TEST 2: Include Connection & Test
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 2: Database Connection</h2>";

try {
    require_once $connection_file;
    
    if (!isset($conn)) {
        throw new Exception("Connection variable \$conn is not set in connect.php");
    }
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<div class='success'>✓ Database connection successful!</div>";
    
    // Get database name
    $result = $conn->query("SELECT DATABASE() as db_name");
    $row = $result->fetch_assoc();
    echo "<p>Connected to database: <code>{$row['db_name']}</code></p>";
    
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    echo "</div></body></html>";
    exit;
}
echo "</div>";

// ============================================
// TEST 3: Check if artworks table exists
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 3: Table Verification</h2>";

$result = $conn->query("SHOW TABLES LIKE 'artworks'");
if ($result->num_rows > 0) {
    echo "<div class='success'>✓ Table 'artworks' exists</div>";
} else {
    echo "<div class='error'>✗ Table 'artworks' does NOT exist!</div>";
    echo "</div></body></html>";
    exit;
}
echo "</div>";

// ============================================
// TEST 4: Count records by status
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 4: Records Count by Status</h2>";

$result = $conn->query("SELECT status, COUNT(*) as count FROM artworks GROUP BY status");
echo "<table>";
echo "<tr><th>Status (as stored)</th><th>Count</th></tr>";
$has_national = false;
$has_local = false;
while ($row = $result->fetch_assoc()) {
    echo "<tr><td><code>{$row['status']}</code></td><td>{$row['count']}</td></tr>";
    if (strtolower($row['status']) === 'national') $has_national = true;
    if (strtolower($row['status']) === 'local') $has_local = true;
}
echo "</table>";

if ($has_national) {
    echo "<div class='success'>✓ Has National artworks</div>";
} else {
    echo "<div class='error'>✗ No National artworks found</div>";
}

if ($has_local) {
    echo "<div class='success'>✓ Has Local artworks</div>";
} else {
    echo "<div class='warning'>⚠ No Local artworks found</div>";
}
echo "</div>";

// ============================================
// TEST 5: Test National Query
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 5: National Artworks Query</h2>";

$query = "SELECT artwork_id, artwork_title, artist, year_created, artwork_desc, category, image, status 
          FROM artworks 
          WHERE (LOWER(status) = 'national' OR status = 'National')
          ORDER BY year_created DESC 
          LIMIT 12";

echo "<h3>Query:</h3>";
echo "<pre>" . htmlspecialchars($query) . "</pre>";

$result = $conn->query($query);

if (!$result) {
    echo "<div class='error'>✗ Query failed: " . $conn->error . "</div>";
} else {
    $count = $result->num_rows;
    echo "<div class='info'>Found <strong>$count</strong> national artworks</div>";
    
    if ($count > 0) {
        echo "<h3>Results:</h3>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Title</th><th>Artist</th><th>Year</th><th>Category</th><th>Status</th><th>Image Path</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['artwork_id']}</td>";
            echo "<td>{$row['artwork_title']}</td>";
            echo "<td>{$row['artist']}</td>";
            echo "<td>{$row['year_created']}</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td><code>{$row['status']}</code></td>";
            echo "<td><code>{$row['image']}</code></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>✗ Query returned 0 results even though national artworks exist!</div>";
    }
}
echo "</div>";

// ============================================
// TEST 6: Test Local Query
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 6: Local Artworks Query</h2>";

$query = "SELECT artwork_id, artwork_title, artist, artwork_desc, category, image, status 
          FROM artworks 
          WHERE (LOWER(status) = 'local' OR status = 'Local')
          ORDER BY artwork_id DESC";

echo "<h3>Query:</h3>";
echo "<pre>" . htmlspecialchars($query) . "</pre>";

$result = $conn->query($query);

if (!$result) {
    echo "<div class='error'>✗ Query failed: " . $conn->error . "</div>";
} else {
    $count = $result->num_rows;
    echo "<div class='info'>Found <strong>$count</strong> local artworks</div>";
    
    if ($count > 0) {
        echo "<h3>Results:</h3>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Title</th><th>Artist</th><th>Category</th><th>Status</th><th>Image Path</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['artwork_id']}</td>";
            echo "<td>{$row['artwork_title']}</td>";
            echo "<td>{$row['artist']}</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td><code>{$row['status']}</code></td>";
            echo "<td><code>{$row['image']}</code></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
echo "</div>";

// ============================================
// TEST 7: Test JSON Response Format
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 7: JSON Response Format Test</h2>";

$query = "SELECT artwork_id, artwork_title, artist, year_created, artwork_desc, category, image 
          FROM artworks 
          WHERE (LOWER(status) = 'national' OR status = 'National')
          ORDER BY year_created DESC 
          LIMIT 12";

$result = $conn->query($query);
$artworks = [];

while ($row = $result->fetch_assoc()) {
    $artworks[] = [
        'id' => $row['artwork_id'],
        'title' => htmlspecialchars($row['artwork_title'], ENT_QUOTES, 'UTF-8'),
        'artist' => htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8'),
        'year' => $row['year_created'],
        'description' => htmlspecialchars($row['artwork_desc'], ENT_QUOTES, 'UTF-8'),
        'category' => htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'),
        'image' => htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8')
    ];
}

$response = [
    'success' => true,
    'artworks' => $artworks,
    'total' => count($artworks),
    'page' => 1,
    'totalPages' => 1,
    'limit' => 12
];

echo "<h3>JSON Response:</h3>";
echo "<pre>" . json_encode($response, JSON_PRETTY_PRINT) . "</pre>";

if (count($artworks) > 0) {
    echo "<div class='success'>✓ JSON format is correct and contains data</div>";
} else {
    echo "<div class='error'>✗ JSON has no artworks data</div>";
}
echo "</div>";

// ============================================
// TEST 8: Test Fetch URL
// ============================================
echo "<div class='test-section'>";
echo "<h2>Test 8: Fetch URL Test</h2>";

echo "<p>Now let's test the actual fetch URL that JavaScript uses:</p>";

// Determine correct path from ARTLIST to backend
$fetch_urls = [
    "../backend/artworks/fetch_artworks.php",
    "../../backend/artworks/fetch_artworks.php",
    "../ADMIN/backend/artworks/fetch_artworks.php"
];

echo "<h3>Testing possible fetch URLs:</h3>";
foreach ($fetch_urls as $url) {
    $full_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $url;
    echo "<p>URL: <code>$url</code><br>";
    echo "Full: <code>$full_url</code><br>";
    
    if (file_exists($url)) {
        echo "<span class='success'>✓ File exists at this path</span></p>";
    } else {
        echo "<span class='error'>✗ File NOT found at this path</span></p>";
    }
}

echo "<div class='warning'>";
echo "<h3>⚠️ Important: Where is this debug file located?</h3>";
echo "<p>This file is at: <code>" . __FILE__ . "</code></p>";
echo "<p>For testing, you need to:</p>";
echo "<ol>";
echo "<li>Place this file in the same directory as <code>artworks.php</code> (in ARTLIST folder)</li>";
echo "<li>Or adjust the paths above based on where you actually placed it</li>";
echo "</ol>";
echo "</div>";

echo "</div>";

$conn->close();
?>

<div class="test-section">
    <h2>✅ Debug Complete</h2>
    <p><strong>Next Steps:</strong></p>
    <ol>
        <li>Review all test results above</li>
        <li>Check for any ✗ errors or ⚠ warnings</li>
        <li>Copy any error messages and share them</li>
        <li>Make sure this debug file is in the correct location (same folder as artworks.php)</li>
    </ol>
</div>

</body>
</html>