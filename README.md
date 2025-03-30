# WhoUnfollowedMe - GitHub Follower Tracker

## Introduction
WhoUnfollowedMe is a simple yet powerful GitHub follower tracker that helps you monitor and analyze changes in your GitHub account followers. This application allows you to easily identify new followers, detect unfollowers, and track your follower trends over time.

## Key Features
- **Check current followers** of any GitHub account
- **Detect new and lost followers** between checks
- **Save follower history** for long-term analysis
- **Compare follower data** between any two points in time
- **Export/import data** for backup or transfer to other devices
- **Filter and export data** by time range (24 hours, 7 days, 30 days, or custom)
- **Support for Personal Access Token** for accounts with many followers

## How to Use

### Checking Followers
1. Enter a GitHub username in the search box
2. (Optional) Enable "Use GitHub Token" for accounts with many followers
3. Select "Update new data from GitHub" to fetch fresh data, or "Use saved data only" to view existing data
4. Click "Check" to display results

### Viewing Followers
- **All** tab: Shows all current followers
- **New** tab: Displays users who started following since the last check
- **Lost** tab: Shows users who unfollowed since the last check
- **History** tab: View and manage your follower history

### Comparing Data
1. Go to the "History" tab
2. Select two time points from the history list to compare
3. Click the "Compare" button to see the changes

### Export/Import Data
- **Export**: Click "Export Data" and choose a time range (all, 24 hours, 7 days, 30 days, or custom)
- **Import**: Click "Import Data" and select a previously exported .json file

## How It Works
The application uses the GitHub API to fetch the follower list of an account. Data is stored locally in your browser (localStorage), allowing tracking of changes over time. No GitHub login is required, though using a Personal Access Token is recommended to avoid API rate limits and access data for accounts with many followers.

## Installation

### Method 1: Direct Use
Since this is a pure web application (HTML/CSS/JavaScript), you can:
1. Download the repository
2. Open the `index.html` file in your browser

### Method 2: Web Deployment
You can deploy this application to any static hosting service:
- GitHub Pages
- Netlify
- Vercel
- Firebase

## Technical Details
- Built with pure HTML, CSS, and JavaScript
- Uses Bootstrap 5 for responsive UI
- Font Awesome for icons
- GitHub REST API for follower data
- Local storage for data persistence
- No server-side code required

## Privacy
- All data is stored locally in your browser
- GitHub tokens are only used for API authentication and never transmitted elsewhere
- The application does not track or collect any user information

## License
MIT
