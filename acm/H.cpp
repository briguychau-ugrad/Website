#include <stdio.h>
#include <string.h>
#include <vector>

using namespace std;

int dp[200][6000];

int main() {
	int t;
	scanf("%d", &t);
	while (t--) {
		int n, m; scanf("%d %d", &n, &m);
		memset(dp, 0, sizeof(dp));
		
		vector<int> scores;
		int x = m;
		while (x--) {
			int q; scanf("%d", &q);
			scores.push_back(q);
			dp[1][q] = q;
		}
		
		for (int i = 2; i < 120; ++i) {
			for (int j = 0; j <= n; ++j) {
				int curr = 0;
				for (int k = 0; k < scores.size(); ++k) {
					if (dp[i-1][j-(i)*scores[k]]) {
						int now = dp[i-1][j-(i)*scores[k]] + scores[k];
						if (now > curr) curr = now;
					}
				}
				dp[i][j] = curr;
			}
		}
		
		int max = -1;
		
		for (int i = 0; i < 120; ++i) {
			if (dp[i][n] && dp[i][n] > max) max = dp[i][n];
		}
		printf("%d\n", max);
	
	}
	return 0;
}

